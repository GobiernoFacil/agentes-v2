<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\Module;
use App\Models\ModuleSession;
use App\Models\Activity;
use App\Models\Answer;
use App\Models\FellowAnswer;
use App\Models\FellowScore;
// FormValidators
use App\Http\Requests\SaveFellowEvaluation;
class FellowEvaluations extends Controller
{
    //

    /**
     * Muestra hoja de calificaciones
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $user     = Auth::user();
      $modules  = Module::orderBy('start','asc')->get();
      return view('fellow.evaluation.evaluation-sheet')->with(
       [
         'user'=>$user,
         'modules' =>$modules
       ]
      );

    }


    /**
     * Muestra hoja de calificaciones
     *
     * @return \Illuminate\Http\Response
     */
    public function get($activity_slug)
    {
      $user      = Auth::user();
      $activity  = Activity::where('slug',$activity_slug)->firstOrFail();
      if($activity->slug === 'examen-diagnostico'){
        return view('fellow.evaluation.evaluation-diagnostic-view')->with(
         [
           'user'=>$user,
         ]);
      }else{
        if(!$activity->quizInfo){
          return redirect('tablero');
        }
        $answers = FellowAnswer::where('user_id',$user->id)->where('questionInfo_id',$activity->quizInfo->id)->get();
        $score   = FellowScore::where('user_id',$user->id)->where('questionInfo_id',$activity->quizInfo->id)->first();
        return view('fellow.evaluation.evaluation-view')->with(
         [
           'user'=>$user,
           'answers'=>$answers,
           'score'  => $score,
           'activity'=>$activity
         ]);
      }
    }

      /**
       * Muestra evaluacion de actividad
       *
       * @return \Illuminate\Http\Response
       */
      public function add($activity_slug)
      {
        $user         = Auth::user();
        $activity     = Activity::where('slug',$activity_slug)->firstOrFail();
        if(!$activity->quizInfo){
          return redirect('tablero');
        }else{
          $check_answer = FellowScore::where('questionInfo_id',$activity->quizInfo->id)->first();
          if($check_answer){
            return redirect("tablero/aprendizaje/{$activity->session->module->slug}/{$activity->session->slug}/{$activity->id}")->with('message','Ya has contestado la evaluación.');
          }
        }

        return view('fellow.evaluation.evaluation-add')->with(
           [
             'user'=>$user,
             'activity'=>$activity
           ]);
    }

    /**
     * Muestra hoja de calificaciones
     *
     * @return \Illuminate\Http\Response
     */
    public function save(SaveFellowEvaluation $request)
    {
      $user = Auth::user();
      $activity = Activity::where('slug',$request->activity_slug)->firstOrFail();
      if(!$activity->quizInfo){
        return redirect('tablero/');
      }
      $data     = $request->except('_token');
      $countP = 1;
      $countQ = $activity->quizInfo->question->count();
      $question_value = 10/$countQ;
      $score = 0;
      foreach ($activity->quizInfo->question as $question) {
        $answer_id = current(array_slice($request->{'answer_q'.$countP}, 0, 1));
        $answer    = Answer::find($answer_id);
        $uAnswer   = new FellowAnswer();
        $uAnswer->user_id = $user->id;
        $uAnswer->question_id = $question->id;
        $uAnswer->questionInfo_id = $activity->quizInfo->id;
        $uAnswer->answer_id = $answer->id;
        if($answer->selected){
          $uAnswer->correct = 1;
          $score  = $score + $question_value;
        }else{
          $uAnswer->correct = 0;
        }
        $uAnswer->save();
        $countP++;
      }
        $uScore = new FellowScore();
        $uScore->user_id = $user->id;
        $uScore->questionInfo_id = $activity->quizInfo->id;
        $uScore->score = $score;
        $uScore->save();
        return redirect("tablero/calificaciones/ver/{$activity->slug}");

    }
}
