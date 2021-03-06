<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
// models
use App\Models\Topic;
use App\Models\ModuleSession;
// FormValidators
use App\Http\Requests\SaveTopic;
use App\Http\Requests\UpdateTopic;

class Topics extends Controller
{
  //
  //Paginación
  public $pageSize = 10;

  /**
  * Búsqueda de temática
  *
  * @return \Illuminate\Http\Response
  */
  public function search()
  {
    //
  }

  /**
  * Muestra lista de temáticas
  *
  * @return \Illuminate\Http\Response
  */
  public function index()
  {
    //
  }

  /**
  * Agregar temática
  *
  * @return \Illuminate\Http\Response
  */
  public function add($session_id)
  {
    //
    $user      = Auth::user();
    $session   = ModuleSession::where('id',$session_id)->firstOrFail();
    return view('admin.modules.topics.topic-add')->with([
      "user"      => $user,
      "session" => $session
    ]);
  }

  /**
  * Guarda nueva temática
  *
  * @param  \Illuminate\Http\Request  $request
  * @return \Illuminate\Http\Response
  */
  public function save(SaveTopic $request)
  {
    //
    $user      = Auth::user();
    $session   = ModuleSession::where('id',$request->session_id)->firstOrFail();
    $topic  = new Topic($request->except('_token'));
    $topic->session_id    = $session->id;
    $topic->save();
    return redirect("dashboard/sesiones/ver/$request->session_id")->with('success',"Se ha guardado correctamente");
  }

  /**
  * Muestra temática
  *
  * @param  int  $id
  * @return \Illuminate\Http\Response
  */
  public function view($id)
  {
    //
    $user    = Auth::user();
    $topic = Topic::find($id);
    return view('admin.modules.topics.topic-view')->with([
      "user"      => $user,
      "topic"    => $topic
    ]);
  }

  /**
  * Muestra contenido para actualizar una temática
  *
  * @param  int  $id
  * @return \Illuminate\Http\Response
  */
  public function edit($id)
  {
    //
    $user      = Auth::user();
    $topic   = Topic::where('id',$id)->firstOrFail();
    $session = ModuleSession::where('id',$topic->session_id)->firstOrFail();
    return view('admin.modules.topics.topic-update')->with([
      "user"    => $user,
      "topic" 	=> $topic,
      "session" => $session
    ]);
  }

  /**
  * Actualiza temática
  *
  * @param  \Illuminate\Http\Request  $request
  * @param  int  $id
  * @return \Illuminate\Http\Response
  */
  public function update(UpdateTopic $request)
  {
    //
    $data   	= $request->except('_token');
    $topic   = Topic::where('id',$request->id)->firstOrFail();
    $session 	= ModuleSession::where('id',$topic->session_id)->firstOrFail();
    
    Topic::where('id',$request->id)->update($data);
    
    return redirect("dashboard/sesiones/ver/$session->id")->with('success',"Se ha actualizado correctamente");
  }

  /**
  * Deshabilita temática
  *
  * @param  int  $id
  * @return \Illuminate\Http\Response
  */
  public function delete($id)
  {
    //
  }
}
