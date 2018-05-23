<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\Activity;
use App\Models\Answer;
use App\Models\FellowAnswer;
use App\Models\FellowAverage;
use App\Models\FilesEvaluation;
use App\Models\FellowScore;
use App\Models\Module;
use App\Models\ModuleSession;
use App\Models\QuizInfo;
use App\Models\RetroLog;
// FormValidators
use App\Http\Requests\SaveFellowEvaluation;
class FellowEvaluations extends Controller
{
    //
    public $pageSize = 10;

    /**
     * Muestra hoja de calificaciones
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $user     = Auth::user();
      $program  = $user->actual_program();
      $modules  = $program->fellow_modules;
      $fellowScores = FellowScore::where('user_id',$user->id)->get();
      $fileScores = FilesEvaluation::where('fellow_id',$user->id)->get();
      $total = $program->get_all_fellow_eva_activities()->count();
      $score  = 0;
      foreach ($fellowScores as $fscore) {
          $score = $score + $fscore->score;
      }
      foreach ($fileScores as $ffscore){
          $score = $score + $ffscore->score;
      }

      if($total!= 0){
        $average = $score/$total;
      }else{
        $average = 0;
      }
      return view('fellow.evaluation.evaluation-sheet')->with(
       [
         'user'=>$user,
         'modules' =>$modules,
         'average' => $average,
         "program" => $program
       ]
      );

    }


	 /**
     * Muestra metodología de calificaciones
     *
     * @return \Illuminate\Http\Response
     */
    public function methodology()
    {
      $user     = Auth::user();
      return view('fellow.evaluation.evaluation-methodology')->with(
       [
         'user'=>$user,
       ]
      );

    }

    /**
     * Muestra evaluacion de actividad
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
     * Muestra evaluacion de archivo
     *
     * @return \Illuminate\Http\Response
     */
    public function getFile($activity_slug)
    {
      $user      = Auth::user();
      $activity  = Activity::where('slug',$activity_slug)->firstOrFail();
      if($activity->files!='Sí'){
        return redirect('tablero');
      }
      $score = FilesEvaluation::where('activity_id',$activity->id)->where('fellow_id',$user->id)->first();
      $retro   = RetroLog::firstOrCreate(['user_id'=>$user->id,'activity_id'=>$activity->id]);
      $retro->status = 1;
      $retro->save();
      return view('fellow.evaluation.evaluation-file-view')->with(
         [
           'user'=>$user,
           'activity'=>$activity,
           'score' =>$score
      ]);

    }

      /**
       * Muestra evaluacion
       *
       * @return \Illuminate\Http\Response
       */
      public function add($program_slug,$activity_slug)
      {
        $user         = Auth::user();
        $activity     = Activity::where('slug',$activity_slug)->firstOrFail();
        if(!$activity->quizInfo){
          return redirect('tablero');
        }else{
          $check_answer = FellowScore::where('questionInfo_id',$activity->quizInfo->id)->where('user_id',$user->id)->first();
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
     * salva evaluacion
     *
     * @return \Illuminate\Http\Response
     */
    public function save(SaveFellowEvaluation $request)
    {
      $user = Auth::user();
      $activity = Activity::where('slug',$request->activity_slug)->firstOrFail();
      $checkScore = FellowScore::where('user_id',$user->id)->where('questionInfo_id',$activity->quizInfo->id)->first();
      if($checkScore){
        return redirect("tablero/aprendizaje/{$activity->session->module->slug}/{$activity->session->slug}/$activity->id");
      }
      if(!$activity->quizInfo){
        return redirect('tablero');
      }
      $data     = $request->except('_token');
      $countP = 1;
      $countQ = $activity->quizInfo->question->count();
      $question_value = 10/$countQ;
      $score = 0;
      foreach ($activity->quizInfo->question as $question) {
        if($question->count_correct($question->id)>1){
           $multiple_score_question = $question_value/$question->count_correct($question->id);
           foreach($request->{'answer_q'.$countP} as $singleAnswer_id){
               $answer    = Answer::find($singleAnswer_id);
               $uAnswer   = new FellowAnswer();
               $uAnswer->user_id = $user->id;
               $uAnswer->question_id = $question->id;
               $uAnswer->questionInfo_id = $activity->quizInfo->id;
               $uAnswer->answer_id = $answer->id;
               if($answer->selected){
                 $uAnswer->correct = 1;
                 $score  = $score + $multiple_score_question;
               }else{
                 $uAnswer->correct = 0;
               }
               $uAnswer->save();
           }

        }else{
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
        }
        $countP++;
      }
       $uScore = new FellowScore();
        $uScore->user_id = $user->id;
        $uScore->questionInfo_id = $activity->quizInfo->id;
        $uScore->score = $score;
        $uScore->save();
        $fellowAverage = new FellowAverage();
        $fellowAverage->scoreSession($activity->id,$user->id,null);
       return redirect("tablero/calificaciones/ver/{$activity->slug}");
    }

    /**
    *
    *
    * @return \Illuminate\Http\Response
    */
    public function download(Request $request){
      $user = Auth::user();
      $data = FilesEvaluation::find($request->score_id);
      $file = $data->path;
      $ext  = substr(strrchr($file,'.'),1);
      $mime = mime_content_type ($file);
      $headers = array(
        'Content-Type: '.$mime,
      );

      $filename = $data->name.".".$ext;
      return response()->download($file, $filename, $headers);
    }



    /**
     * Lista de evaluaciones del usuario
     *
     * @return \Illuminate\Http\Response
     */
    public function indexEvaluations()
    {
      $user               = Auth::user();
      /*$activities         = Activity::where('type','evaluation')
      ->orderBy('session_id','asc')
      ->paginate($this->pageSize);*/
      $modules = Module::where('public',1)->orderBy('start','asc')->paginate($this->pageSize);
      $today = date("Y-m-d");

      return view('fellow.evaluation.evaluation-list-view')->with(
         [
           'user'=>$user,
           'modules' =>$modules,
           'today' => $today
      ]);

    }


}
