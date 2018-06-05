<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\Activity;
use App\Models\FellowScore;
use App\Models\FilesEvaluation;
use App\Models\FellowAnswer;
use App\Models\FellowAverages;
use App\Models\ForumLog;
use App\Models\Module;
use App\Models\ModuleSession;
use App\Models\Program;

class FellowAverage extends Controller
{


  /**
   * Muestra hoja de calificaciones
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    $user     = Auth::user();
    $program  = $user->actual_program();
    $modules  = $program->get_active_modules()->paginate(10);
    return view('fellow.evaluation.evaluation-sheet')->with(
     [
       'user'=>$user,
       'modules' =>$modules,
       "program" => $program
     ]
   );

  }

  /**
   * Muestra hoja de calificaciones por módulo
   *
   * @return \Illuminate\Http\Response
   */
  public function moduleScores($program_slug,$module_slug)
  {
    $user     = Auth::user();
    $today    = date('Y-m-d');
    $program  = $user->actual_program();
    $module   = Module::where('start','<=',$today)->where('slug',$module_slug)->firstOrFail();
    return view('fellow.evaluation.evaluation-module-sheet')->with(
     [
       'user'=>$user,
       'module' =>$module,
       "program" => $program
     ]
   );

  }

  /**
   * Muestra evaluacion de actividad
   *
   * @return \Illuminate\Http\Response
   */
  public function get($program_slug,$activity_slug)
  {
    $user      = Auth::user();
    $program   = $user->actual_program();
    $activity  = Activity::where('slug',$activity_slug)->firstOrFail();
    if(!$activity->quizInfo){
        return redirect('tablero');
    }
    $answers = FellowAnswer::where('user_id',$user->id)->where('questionInfo_id',$activity->quizInfo->id)->get();
    $score   = FellowScore::where('user_id',$user->id)->where('questionInfo_id',$activity->quizInfo->id)->first();
      return view('fellow.evaluation.evaluation-view')->with(
       [
         'user'     => $user,
         'answers'  => $answers,
         'score'    => $score,
         'activity' => $activity,
         'program'  => $program
       ]);
    }


}
