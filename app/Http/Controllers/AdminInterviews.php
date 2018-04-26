<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\Aspirant;
use App\Models\AspirantInterview;
use App\Models\Interview;
use App\Models\InterviewAnswer;
use App\Models\InterviewGlobalScore;
use App\Models\Notice;
// FormValidators
use App\Http\Requests\SaveInterview;
class AdminInterviews extends Controller
{
    //

    /**
     * Muestra lista de entrevistas
     *
     * @return \Illuminate\Http\Response
     */
    public function index($notice_id)
    {
        //
        //
        $user      = Auth::user();
        $notice    = Notice::where('id',$notice_id)->firstOrFail();
        $aspirants = $notice->all_aspirants_data()->get();
        $list      = $notice->aspirants_per_institution_to_interview()->paginate();
        $asToE_count = $notice->aspirants_per_institution_to_interview()->count();
        $aAe_count  = $notice->aspirants_inter_already_evaluated()->count();
        $aIaE_count = $notice->aspirants_inter_already_evaluated_by_institution($user->institution)->count();
        $type_list = 1;
        return view('admin.aspirants.interviews.aspirant-list-per-institution')->with([
          'user' =>$user,
          'notice' => $notice,
          'aspirants' =>$aspirants,
          'list' =>$list,
          'type_list' => $type_list,
          'asToE_count' => $asToE_count,
          'aAe_count'  =>$aAe_count,
          'aIaE_count' =>$aIaE_count
        ]);
    }

    /**
     * Muestra aspirantes de convocatoria con entrevista por institucion
     *
     * @return \Illuminate\Http\Response
     */
    public function interviewed($notice_id)
    {
        //
        $user      = Auth::user();
        $notice    = Notice::where('id',$notice_id)->firstOrFail();
        $aspirants = $notice->all_aspirants_data()->get();
        $list      = $notice->aspirants_inter_already_evaluated_by_institution($user->institution)->paginate();
        $asToE_count = $notice->aspirants_per_institution_to_interview()->count();
        $aAe_count  = $notice->aspirants_inter_already_evaluated()->count();
        $aIaE_count = $notice->aspirants_inter_already_evaluated_by_institution($user->institution)->count();
        $type_list = 2;
        return view('admin.aspirants.interviews.aspirant-list-per-institution')->with([
          'user' =>$user,
          'notice' => $notice,
          'aspirants' =>$aspirants,
          'list' =>$list,
          'type_list' => $type_list,
          'asToE_count' => $asToE_count,
          'aAe_count'  =>$aAe_count,
          'aIaE_count' =>$aIaE_count
        ]);


    }

    /**
     * Muestra aspirantes de convocatoria con entrevista por institucion
     *
     * @return \Illuminate\Http\Response
     */
    public function allInterviewed($notice_id)
    {
        //
        $user      = Auth::user();
        $notice    = Notice::where('id',$notice_id)->firstOrFail();
        $aspirants = $notice->all_aspirants_data()->get();
        $list      = $notice->aspirants_inter_already_evaluated()->paginate();
        $asToE_count = $notice->aspirants_per_institution_to_interview()->count();
        $aAe_count  = $notice->aspirants_inter_already_evaluated()->count();
        $aIaE_count = $notice->aspirants_inter_already_evaluated_by_institution($user->institution)->count();
        $type_list = 0;
        $aspirants_id = $aspirants->pluck('id');
        $states = Aspirant::select('state')->whereIn('id',$aspirants_id->toArray())->distinct()->orderBy('state','asc')->pluck('state','state')->toArray();
        $states[null] = "Selecciona un estado";
        return view('admin.aspirants.interviews.aspirant-list-per-institution')->with([
          'user' =>$user,
          'notice' => $notice,
          'aspirants' =>$aspirants,
          'list' =>$list,
          'type_list' => $type_list,
          'asToE_count' => $asToE_count,
          'aAe_count'  =>$aAe_count,
          'aIaE_count' =>$aIaE_count,
          'states'     => $states
        ]);


    }

    /**
     * Muestra todos los aspirantes de convocatoria con aplicacion evaluada por estado
     *
     * @return \Illuminate\Http\Response
     */
    public function interviewedByState($notice_id,$state)
    {
        //
        $user      = Auth::user();
        $notice    = Notice::where('id',$notice_id)->firstOrFail();
        $aspirants = $notice->all_aspirants_data()->get();
        $list      = $notice->aspirants_inter_already_evaluated_by_state($state)->paginate();
        $asToE_count = $notice->aspirants_per_institution_to_interview()->count();
        $aAe_count  = $notice->aspirants_inter_already_evaluated()->count();
        $aIaE_count = $notice->aspirants_inter_already_evaluated_by_institution($user->institution)->count();
        $type_list = 0;
        $aspirants_id = $aspirants->pluck('id');
        $states = Aspirant::select('state')->whereIn('id',$aspirants_id->toArray())->distinct()->orderBy('state','asc')->pluck('state','state')->toArray();
        $states[null] = "Selecciona un estado";
        return view('admin.aspirants.interviews.aspirant-list-per-institution')->with([
          'user' =>$user,
          'notice' => $notice,
          'aspirants' =>$aspirants,
          'list' =>$list,
          'type_list' => $type_list,
          'asToE_count' => $asToE_count,
          'aAe_count'  =>$aAe_count,
          'aIaE_count' =>$aIaE_count,
          'states'     => $states
        ]);


    }


    /**
     * Muestra lista de entrevistas
     *
     * @return \Illuminate\Http\Response
     */
    public function add($notice_id,$aspirant_id)
    {
        //
        //
        $user          = Auth::user();
        $notice        = Notice::where('id',$notice_id)->firstOrFail();
        $interview     = Interview::where('notice_id',$notice->id)->where('institution',$user->institution)->where('aspirant_id',$aspirant_id)->firstOrFail();
        $questionnaire = $notice->interview_questionnaire;

        return view('admin.aspirants.interviews.aspirant-add-interview-evaluation')->with([
          'user' =>$user,
          'notice' => $notice,
          'interview' =>$interview,
          'questionnaire' =>$questionnaire
        ]);
    }


    /**
     * salva entrevista
     *
     * @return \Illuminate\Http\Response
     */
    public function save(SaveInterview $request)
    {

      $user          = Auth::user();
      $notice        = Notice::where('id',$request->notice_id)->firstOrFail();
      $interview     = Interview::where('notice_id',$notice->id)->where('institution',$user->institution)->where('aspirant_id',$request->aspirant_id)->firstOrFail();
      $questionnaire = $notice->interview_questionnaire;
      $count = 1;
      $required = 1;
      $score    = 0;

      foreach ($questionnaire->questions as $question) {
        $name   = 'question_'.$count.'_'.$question->id;
        //multiple rows and columns type radio
        if($question->options_rows_number > 1 && $question->type === 'radio'){
          //not yet
        /*   foreach ($question->answers as $answer) {
             # code...
             $temp_name = $name.'_'.$answer->id;
             $data = current(array_slice($request->{$temp_name}, 0, 1));
             $answer =
             InterviewAnswer::firstOrCreate([
             'aspirant_interview_id'=>$interview->id,
             'interview_questionnaire_id'=>$questionnaire->id,
             'question_id'=>$question->id,
             'answer_id'=>$answer->id,
             'facilitator_id'=>$request->facilitator_id,
             'session_id' => $request->session_id
             ]);
             $answer->answer = $data;
             $answer->save();
           }
           */

        }elseif($question->options_rows_number === 1 && $question->type === 'radio'){
          //one row type radio
          $data = current(array_slice($request->{$name}, 0, 1));
          $answer = InterviewAnswer::firstOrCreate([
            'aspirant_interview_id'=>$interview->id,
            'interview_questionnaire_id'=>$questionnaire->id,
            'question_id'=>$question->id,
          ]);
          $answer->answer = $data;
          $answer->save();
        }else{
          //open question
            $answer = InterviewAnswer::firstOrCreate([
              'aspirant_interview_id'=>$interview->id,
              'interview_questionnaire_id'=>$questionnaire->id,
              'question_id'=>$question->id,
            ]);
            $answer->answer = $request->{$name};
            $answer->save();
        }

        $count++;
          if($question->required && $question->type ==='radio'){
            $data = current(array_slice($request->{$name}, 0, 1));
            $score = $score + intval($data);
            $required++;
          }
        //
      }

      $score = ceil($score/$required);
      $interview_score = AspirantInterview::firstOrCreate(['aspirant_id'=>$request->aspirant_id,
                                                           'notice_id'=>$notice->id,
                                                           'interview_questionnaire_id'=>$questionnaire->id,
                                                           'type'=>$interview->type,
                                                           'institution'=>$user->institution]);
      $interview_score->user_id = $user->id;
      $interview_score->score   = $score;
      $interview_score->save();
      $this->update_global_score($request->aspirant_id,$notice);

      return redirect("dashboard/aspirantes/convocatoria/$notice->id/entrevistas")->with(['success'=>"Se ha guardado correctamente"]);

    }


    function update_global_score($aspirant_id,$notice){
      $total           =  AspirantInterview::where('aspirant_id',$aspirant_id)->where('notice_id',$notice->id)->count();
      $interview_score =  AspirantInterview::where('aspirant_id',$aspirant_id)->where('notice_id',$notice->id)->sum('score');
      $global          =  InterviewGlobalScore::firstOrCreate(['aspirant_id'=>$aspirant_id,'notice_id'=>$notice->id]);
      $global->score   =  ceil($interview_score/$total);
      $global->save();
      return true;

    }
}
