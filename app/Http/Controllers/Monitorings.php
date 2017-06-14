<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
// models
use App\Models\Monitoring;
use App\Models\ModuleSession;
// FormValidators
use App\Http\Requests\SaveMonitoring;
use App\Http\Requests\UpdateMonitoring;
class Monitorings extends Controller
{
  //
  //Paginación
  public $pageSize = 10;

  /**
  * Búsqueda de Mecanismo de Monitoreo
  *
  * @return \Illuminate\Http\Response
  */
  public function search()
  {
    //
  }

  /**
  * Muestra lista de Mecanismos de Monitoreo
  *
  * @return \Illuminate\Http\Response
  */
  public function index()
  {
    //
  }

  /**
  * Agregar Mecanismo de Monitoreo
  *
  * @return \Illuminate\Http\Response
  */
  public function add($session_id)
  {
    //
    $user      = Auth::user();
    $session   = ModuleSession::where('id',$session_id)->firstOrFail();
    return view('admin.modules.monitoring.monitoring-add')->with([
      "user"      => $user,
      "session" => $session
    ]);
  }

  /**
  * Guarda nuevo Mecanismo de Monitoreo
  *
  * @param  \Illuminate\Http\Request  $request
  * @return \Illuminate\Http\Response
  */
  public function save(SaveMonitoring $request)
  {
    //
    $user      = Auth::user();
    $session   = ModuleSession::where('id',$request->session_id)->firstOrFail();
    $monitoring  = new Monitoring($request->except('_token'));
    $monitoring->session_id    = $session->id;
    $monitoring->save();
    return redirect("dashboard/sesiones/ver/$request->session_id")->with('success',"Se ha guardado correctamente");
  }

  /**
  * Muestra Mecanismo de Monitoreo
  *
  * @param  int  $id
  * @return \Illuminate\Http\Response
  */
  public function view($id)
  {
    //
    $user    = Auth::user();
    $monitoring = Monitoring::find($id);
    return view('admin.modules.monitoring.monitoring-view')->with([
      "user"      => $user,
      "monitoring"    => $monitoring
    ]);
  }

  /**
  * Muestra contenido para actualizar un Mecanismo de Monitoreo
  *
  * @param  int  $id
  * @return \Illuminate\Http\Response
  */
  public function edit($id)
  {
    //
    $user      = Auth::user();
    $monitoring   = Monitoring::where('id',$id)->firstOrFail();
    return view('admin.modules.monitoring.monitoring-update')->with([
      "user"      => $user,
      "monitoring" => $monitoring
    ]);
  }

  /**
  * Actualiza Mecanismo de Monitoreo
  *
  * @param  \Illuminate\Http\Request  $request
  * @param  int  $id
  * @return \Illuminate\Http\Response
  */
  public function update(UpdateMonitoring $request)
  {
    //
    $data   = $request->except('_token');
    $monitoring = Monitoring::where('id',$request->id)->firstOrFail();

    Monitoring::where('id',$request->id)->update($data);

    return redirect("dashboard/sesiones/ver/$monitoring->session_id")->with('success',"Se ha guardado correctamente");

  }

  /**
  * Deshabilita Mecanismo de Monitoreo
  *
  * @param  int  $id
  * @return \Illuminate\Http\Response
  */
  public function delete($id)
  {
    //
  }
}
