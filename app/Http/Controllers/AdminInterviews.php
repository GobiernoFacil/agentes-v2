<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\Interview;
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

      $user            = Auth::user();
      $questionnaire   = CustomQuestionnaire::where('type','facilitator')->firstOrFail();
      $session     = ModuleSession::where('id',$request->session_id)->firstOrFail();
      $facilitator = User::where('id',$request->facilitator_id)->firstOrFail();
      $count = 1;

      foreach ($questionnaire->questions as $question) {
        $name   = 'question_'.$count.'_'.$question->id;
        //multiple rows and columns type radio
        if($question->options_rows_number > 1){
           foreach ($question->answers as $answer) {
             # code...
             $temp_name = $name.'_'.$answer->id;
             $data = current(array_slice($request->{$temp_name}, 0, 1));
             $answer =
             CustomFellowAnswer::firstOrCreate([
             'user_id'=>$user->id,
             'questionnaire_id'=>$questionnaire->id,
             'question_id'=>$question->id,
             'answer_id'=>$answer->id,
             'facilitator_id'=>$request->facilitator_id,
             'session_id' => $request->session_id
             ]);
             $answer->answer = $data;
             $answer->save();
           }

        }elseif($question->options_rows_number === 1){
          //one row type radio
          $data = current(array_slice($request->{$name}, 0, 1));
          $answer = CustomFellowAnswer::firstOrCreate([
            'user_id'=>$user->id,
            'questionnaire_id'=>$questionnaire->id,
            'question_id'=>$question->id,
            'facilitator_id'=>$request->facilitator_id,
            'session_id' => $request->session_id
          ]);
          $answer->answer = $data;
          $answer->save();
        }else{
          //open question
            $answer = CustomFellowAnswer::firstOrCreate([
              'user_id'=>$user->id,
              'questionnaire_id'=>$questionnaire->id,
              'question_id'=>$question->id,
              'facilitator_id'=>$request->facilitator_id,
              'session_id' => $request->session_id
            ]);
            $answer->answer = $request->{$name};
            $answer->save();
        }

        $count++;
      }

      return redirect("tablero/encuestas/facilitadores-sesiones/$session->slug/$facilitator->name/gracias")->with(['success'=>"Se ha guardado correctamente",'fac_survey' =>true]);

    }
}
