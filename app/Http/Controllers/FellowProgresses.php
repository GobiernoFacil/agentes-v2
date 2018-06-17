<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Mail;
//Models
use App\User;
use App\Models\Module;
use App\Models\Aspirant;
use App\Models\AspirantsFile;
use App\Models\FileEvaluation;
use App\Models\FellowProgress;
use App\Models\FellowAverage;
use App\Models\FellowAnswer;
use App\Models\City;
use App\Models\AspirantEvaluation;
use App\Models\Institution;
use App\Models\FellowScore;
use App\Models\QuizInfo;
use App\Models\FilesEvaluation;
use App\Models\Activity;
use App\Models\Program;
class FellowProgresses extends Controller
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
      $program  = $user->actual_program();
      $modules  = $program->get_active_modules()->paginate(10);
      return view('fellow.progress.progress-sheet')->with(
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
    public function module($program_slug,$module_slug)
    {
      $user     = Auth::user();
      $today    = date('Y-m-d');
      $program  = $user->actual_program();
      $module   = Module::where('start','<=',$today)->where('slug',$module_slug)->firstOrFail();
      return view('fellow.progress.progress-module-sheet')->with(
       [
         'user'=>$user,
         'module' =>$module,
         "program" => $program
       ]
     );

    }
}
