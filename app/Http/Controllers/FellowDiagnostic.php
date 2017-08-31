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
          $answer = CustomFellowAnswer::firstOrCreate(['user_id'=>$user->id,'questionnaire_id'=>$questionnaire->id,'question_id'=>$question->id]);
          $answer->answer = $request->{$name};
          $answer->save();
          $count++;
        }

        return redirect('tablero')->with(['message'=>'Se ha guardado correctamente']);


    }

}
