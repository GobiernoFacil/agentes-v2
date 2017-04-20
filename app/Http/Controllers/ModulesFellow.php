<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
// models
use App\Models\Module;
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
      $list = Module::orderBy('order')->paginate($this->pageSize);
      return view('fellow.modules.module-list')->with([
        "user"      => $user,
        "modules"  => $list]);
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
      $module  = Module::where('slug',$slug)->first();
      return view('fellow.modules.module-view')->with([
        "user"      => $user,
        "module"    => $module
      ]);
    }
}
