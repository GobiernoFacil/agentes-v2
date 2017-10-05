<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\CustomQuestionnaire;
use App\Models\CustomFellowAnswer;
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
          return redirect('tablero');
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

}
