<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\Module;
use App\Models\ModuleSession;
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
}
