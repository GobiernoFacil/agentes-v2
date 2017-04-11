<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
// models
use App\Models\Module;
use App\Models\ModuleSession;
// FormValidators
use App\Http\Requests\SaveSession;
use App\Http\Requests\UpdateSession;
class ModuleSessions extends Controller
{
    //
    //
    //Paginación
    public $pageSize = 10;

    /**
    * Búsqueda de sesión
    *
    * @return \Illuminate\Http\Response
    */
    public function search()
    {
      //
    }

    /**
    * Muestra lista de sesiones
    *
    * @return \Illuminate\Http\Response
    */
    public function index($id)
    {
      //
      $user    = Auth::user();
      $module  = Module::find($id)->with('sessions')->paginate($this->pageSize);
      return view('admin.modules.sessions.session-list')->with([
        'user' => $user,
        'module' =>$module,
      ]);

    }

    /**
    * Agregar sesión
    *
    * @return \Illuminate\Http\Response
    */
    public function add($module_id)
    {
      $user   = Auth::user();
      return view('admin.modules.sessions.session-add')->with([
        "user"      => $user,
        "module_id" => $module_id
      ]);
    }

    /**
    * Guarda nueva sesión
    *
    * @param  \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
    */
    public function save(Request $request)
    {
      //
    /*  $user   = Auth::user();
      $data   = $request->except('_token');
      $data['module_id']    = $request->module_id;
      $session = new ModuleSession($data);
      $session->save();
      return redirect("dashboard/sesiones/ver/$session->id")->with('success',"Se ha guardado correctamente");*/
      $order   = $request->order;
      $numbers = ModuleSession::all()->pluck('id','order')->toArray();
      var_dump($numbers[$order]);
    }

    /**
    * Muestra sesión
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    public function view($id)
    {
      //
      $user    = Auth::user();
      $session = ModuleSession::find($id);
      return view('admin.modules.sessions.session-view')->with([
        "user"      => $user,
        "session"    => $session
      ]);
    }

    /**
    * Muestra contenido para actualizar una sesión
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    public function edit($session_id)
    {
      //
      $user = Auth::user();
      $session = ModuleSession::find($session_id);
      return view('admin.modules.sessions.session-update')->with([
        'user' => $user,
        'session' =>$session,
      ]);
    }

    /**
    * Actualiza sesión
    *
    * @param  \Illuminate\Http\Request  $request
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    public function update(UpdateSession $request)
    {
      //
      $data   = $request->except('_token');
      ModuleSession::where('id',$request->session_id)->update($data);
      return redirect("dashboard/sesiones/ver/$request->session_id")->with('success',"Se ha actualizado correctamente");
    }

    /**
    * Deshabilita sesión
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    public function delete($id)
    {
      //
    }


}
