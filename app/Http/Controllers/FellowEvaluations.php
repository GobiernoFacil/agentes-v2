<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\Activity;
use App\Models\Answer;
use App\Models\FellowAnswer;
use App\Models\FellowAverage;
use App\Models\FilesEvaluation;
use App\Models\FellowProgress;
use App\Models\FellowScore;
use App\Models\Module;
use App\Models\ModuleSession;
use App\Models\Program;
use App\Models\QuizInfo;
use App\Models\RetroLog;
// FormValidators
use App\Http\Requests\SaveFellowEvaluation;
class FellowEvaluations extends Controller
{
    //
    public $pageSize = 10;

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
          if($activity->fellowScore($user->id)){
             return redirect("tablero/{$activity->session->module->program->slug}/aprendizaje/{$activity->session->module->slug}/{$activity->session->slug}/{$activity->slug}")->with('message','Ya has contestado la evaluación.');
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
      if($activity->fellowScore($user->id)){
        return redirect("tablero/{$activity->session->module->program->slug}/aprendizaje/{$activity->session->module->slug}/{$activity->session->slug}/{$activity->slug}");
      }
      if(!$activity->quizInfo){
        return redirect('tablero');
      }
      $data     = $request->except('_token');
      $countP = 1;
      $question_value = 10/$activity->quizInfo->question->count();
      $score = 0;
      foreach ($activity->quizInfo->question as $question) {
        if($question->count_correct($question->id)>1){
           $multiple_score_question = $question_value/$question->count_correct($question->id);
           foreach($request->{'answer_q'.$countP} as $singleAnswer_id){
               $answer    = Answer::find($singleAnswer_id);
               $uAnswer   = FellowAnswer::firstOrCreate([
                 'user_id'          => $user->id,
                 'question_id'      => $question->id,
                 'questionInfo_id'  => $activity->quizInfo->id,
                 'answer_id'        => $answer->id
               ]);
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
          $uAnswer   = FellowAnswer::firstOrCreate([
            'user_id'          => $user->id,
            'question_id'      => $question->id,
            'questionInfo_id'  => $activity->quizInfo->id,
            'answer_id'        => $answer->id
          ]);
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
        $uScore = FellowScore::firstOrCreate([
          'user_id'            =>  $user->id,
          'questionInfo_id'    =>  $activity->quizInfo->id
        ]);
        $uScore->score = $score;
        $uScore->save();
        $fellowAverage = FellowAverage::firstOrCreate([
          'user_id'    => $user->id,
          'module_id'  => $activity->session->module->id,
          'session_id' => $activity->session->id,
          'type'       => 'session',
          'program_id' => $activity->session->module->program->id,

        ]);
        $fellowAverage->scoreSession();
        $fellowProgress  = FellowProgress::firstOrCreate([
          'fellow_id'    => $user->id,
          'module_id'    => $activity->session->module->id,
          'session_id'   => $activity->session->id,
          'activity_id'  => $activity->id,
          'program_id'   => $activity->session->module->program->id,
        ]);
        $fellowProgress->status = 1;
        $fellowProgress->save();
       return redirect("tablero/{$activity->session->module->program->slug}/calificaciones/ver/{$activity->slug}");
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
