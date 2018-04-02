<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
// models
use App\Models\Module;
use App\Models\Log;
class ModulesFellow extends Controller
{

  //Paginación
  public $pageSize = 10;
    //

    /**
     * Muestra lista de módulos
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $user = Auth::user();
      $program = $user->actual_program();
      $list = $program->modules()->where('public',1)->orderBy('start','asc')->paginate($this->pageSize);
      $today = date("Y-m-d");
      return view('fellow.modules.module-list')->with([
        "user"      => $user,
        "modules"   => $list,
        "today"     => $today,
        "program"   => $program
      ]);
    }

    /**
    * Muestra módulo
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    public function view($program_slug,$module_slug)
    {
      //
      $user    = Auth::user();
      $module  = Module::where('slug',$module_slug)->firstOrFail();
      $today = date("Y-m-d");
      $log     = Log::firstOrCreate(['user_id'=>$user->id,'type'=>'view']);
      $log->session_id = null;
      $log->module_id = $module->id;
      $log->activity_id = null;
      $log->save();
      return view('fellow.modules.module-view')->with([
        "user"      => $user,
        "module"    => $module,
        "today" =>$today
      ]);
    }
}
