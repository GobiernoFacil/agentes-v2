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
      $list = Module::where('public',1)->orderBy('start','asc')->paginate($this->pageSize);
      $today = date("Y-m-d");
      return view('fellow.modules.module-list')->with([
        "user"      => $user,
        "modules"  => $list,
        "today" =>$today
      ]);
    }

    /**
    * Muestra módulo
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    public function view($slug)
    {
      //
      $user    = Auth::user();
      $module  = Module::where('slug',$slug)->firstOrFail();
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
