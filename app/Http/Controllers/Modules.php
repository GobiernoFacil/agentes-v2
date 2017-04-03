<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
// models
use App\Models\Module;

class Modules extends Controller
{
  //

  /**
  * Búsqueda de módulo
  *
  * @return \Illuminate\Http\Response
  */
  public function search()
  {
    //
  }

  /**
  * Muestra lista de módulos
  *
  * @return \Illuminate\Http\Response
  */
  public function index()
  {
    //
  }

  /**
  * Agregar módulo
  *
  * @return \Illuminate\Http\Response
  */
  public function add()
  {
    $user   = Auth::user();
    $module = Module::firstOrCreate([]);
    return view('admin.modules.module-add')->with([
      "user"      => $user,
      "module"    => $module
    ]);
  }

  /**
  * Guarda nuevo módulo
  *
  * @param  \Illuminate\Http\Request  $request
  * @return \Illuminate\Http\Response
  */
  public function save(Request $request)
  {
    //
  }

  /**
  * Muestra módulo
  *
  * @param  int  $id
  * @return \Illuminate\Http\Response
  */
  public function view($id)
  {
    //
  }

  /**
  * Muestra contenido para actualizar un módulo
  *
  * @param  int  $id
  * @return \Illuminate\Http\Response
  */
  public function edit($id)
  {
    //
  }

  /**
  * Actualiza módulo
  *
  * @param  \Illuminate\Http\Request  $request
  * @param  int  $id
  * @return \Illuminate\Http\Response
  */
  public function update(Request $request, $id)
  {
    //
  }

  /**
  * Deshabilita módulo
  *
  * @param  int  $id
  * @return \Illuminate\Http\Response
  */
  public function delete($id)
  {
    //
  }


}
