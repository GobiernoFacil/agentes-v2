<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\Activity;
use App\Models\CustomQuestionnaire;
use App\Models\CustomFellowAnswer;
use App\Models\Log;
// FormValidators
use App\Http\Requests\SaveCustomTest;
class FellowDiagnostic extends Controller
{
    //
    /**
     * Ver prueba diagnostico
     *
     * @return \Illuminate\Http\Response
     */
    public function get_test($slug)
    {
        //
        $user            = Auth::user();
        $questionnaire   = CustomQuestionnaire::where('slug',$slug)->firstOrFail();
        $answers         = CustomFellowAnswer::where('user_id',$user->id)->where('questionnaire_id',$questionnaire->id)->first();
        if($answers){
          return redirect('tablero')->with(['message'=>'Ya has contestado la evaluación ¡Gracias!']);
        }
        return view('fellow.diagnostic.custom-test')->with([
          "user"      => $user,
          "questionnaire" => $questionnaire
        ]);
    }

    /**
     * Ver prueba diagnostico
     *
     * @return \Illuminate\Http\Response
     */
    public function save_test(SaveCustomTest $request)
    {
        //
        $user            = Auth::user();
        $questionnaire   = CustomQuestionnaire::where('slug',$request->slug)->firstOrFail();
        $count = 1;

        foreach ($questionnaire->questions as $question) {
          $name   = 'question_'.$count.'_'.$question->id;
          //multiple rows and columns type radio
          if($question->options_rows_number > 1){
             foreach ($question->answers as $answer) {
               # code...
               $temp_name = $name.'_'.$answer->id;
               $data = current(array_slice($request->{$temp_name}, 0, 1));
               $answer = CustomFellowAnswer::firstOrCreate(['user_id'=>$user->id,'questionnaire_id'=>$questionnaire->id,'question_id'=>$question->id,'answer_id'=>$answer->id]);
               $answer->answer = $data;
               $answer->save();
             }

          }elseif($question->options_rows_number === 1){
            //one row type radio
            $data = current(array_slice($request->{$name}, 0, 1));
            $answer = CustomFellowAnswer::firstOrCreate(['user_id'=>$user->id,'questionnaire_id'=>$questionnaire->id,'question_id'=>$question->id]);
            $answer->answer = $data;
            $answer->save();
          }else{
            //open question
              $answer = CustomFellowAnswer::firstOrCreate(['user_id'=>$user->id,'questionnaire_id'=>$questionnaire->id,'question_id'=>$question->id]);
              $answer->answer = $request->{$name};
              $answer->save();
          }

          $count++;
        }

        return redirect('tablero')->with(['message'=>'Se ha guardado correctamente']);


    }


    public function add($program_slug,$activity_slug){
      $user      = Auth::user();
      $activity  = Activity::where('slug',$activity_slug)->firstOrFail();
      if($user->new_diagnostic($activity->diagnosticInfo->id)->count() > 0){
        return redirect("tablero/$program_slug/aprendizaje/{$activity->session->module->slug}/{$activity->session->slug}/$activity->slug")->with('error','Ya has contestado la evaluación');
      }
      $log     = Log::firstOrCreate(['user_id'=>$user->id,'type'=>'activity']);
      $log->session_id  = $activity->session->id;
      $log->module_id   = $activity->session->module->id;
      $log->activity_id = $activity->id;
      $log->program_id  = $activity->session->module->program->id;
      $log->save();
      return view('fellow.diagnostic.custom-test')->with([
        "user"      => $user,
        "activity"  => $activity
      ]);
    }


    public function save(SaveCustomTest $request){

    }




}
