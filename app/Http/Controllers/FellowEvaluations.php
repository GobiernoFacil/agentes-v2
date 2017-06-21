<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\Module;
use App\Models\ModuleSession;
use App\Models\Activity;
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
        return redirect('tablero');
      }
    }

      /**
       * Muestra evaluacion de actividad
       *
       * @return \Illuminate\Http\Response
       */
      public function add($activity_slug)
      {
        $user      = Auth::user();
        $activity  = Activity::where('slug',$activity_slug)->firstOrFail();
        if(!$activity->quizInfo){
          return redirect('tablero');
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
    
    }
}
