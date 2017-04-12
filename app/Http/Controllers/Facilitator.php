<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Hash;

use Mail;
// models
use App\User;
use App\Models\ModuleSession;
// FormValidators
use App\Http\Requests\SaveFacilitator;
use App\Http\Requests\UpdateFacilitator;
class Facilitator extends Controller
{
  //Paginación
  public $pageSize = 10;

  /**
  * Búsqueda de usuario
  *
  * @return \Illuminate\Http\Response
  */
  public function search()
  {
    //
  }

  /**
  * Muestra lista de usuario
  *
  * @return \Illuminate\Http\Response
  */
  public function index()
  {
    //
    $user = Auth::user();
    $list = User::where("type", "facilitator")->paginate($this->pageSize);
    return view('admin.users.facilitator-list')->with([
      "user"      => $user,
      "facilitators"  => $list]);
  }

  /**
  * Agregar usuario
  *
  * @return \Illuminate\Http\Response
  */
  public function add()
  {
    //
    $user = Auth::user();
    return view('admin.users.facilitator-add')->with([
      "user"      => $user
    ]);
  }

  /**
  * Guarda nuevo usuario
  *
  * @param  \Illuminate\Http\Request  $request
  * @return \Illuminate\Http\Response
  */
  public function save(SaveFacilitator $request)
  {
    //
    $facilitator           = new User($request->except('_token'));
    $facilitator->type     = "facilitator";
    $facilitator->enabled  = 1;
    $request->password     = str_random(12);
    $facilitator->password = Hash::make($request->password);
    $facilitator->save();
    //envía correo
    $from    = "info@apertus.org.mx";
    $subject = "Bienvenido al Programa de Formación de Agentes Locales de Cambio en Gobierno Abierto y Desarrollo Sostenible";
   //enviar correo para confirmar dirección de correo
    Mail::send('emails.new_user', ['user' => $facilitator,'request'=>$request], function($message) use ($facilitator,$from, $subject) {
            $message->from($from, 'no-reply');
            $message->to($facilitator->email);
            $message->subject($from);
    });
   return redirect("dashboard/facilitadores/ver/$facilitator->id")->with('message','Usuario creado correctamente');
  }

  /**
  * Muestra usuario
  *
  * @param  int  $id
  * @return \Illuminate\Http\Response
  */
  public function view($id)
  {
    //
    $user    = Auth::user();
    $facilitator = User::find($id);
    return view('admin.users.facilitator-view')->with([
      "user"      => $user,
      "facilitator"    => $facilitator
    ]);
  }

  /**
  * Muestra contenido para actualizar un usuario
  *
  * @param  int  $id
  * @return \Illuminate\Http\Response
  */
  public function edit($id)
  {
    //
    $user      = Auth::user();
    $facilitator   = User::where('id',$id)->firstOrFail();
    return view('admin.users.facilitator-update')->with([
      "user"      => $user,
      "facilitator" => $facilitator
    ]);
  }

  /**
  * Actualiza usuario
  *
  * @param  \Illuminate\Http\Request  $request
  * @param  int  $id
  * @return \Illuminate\Http\Response
  */
  public function update(UpdateFacilitator $request)
  {
    //
    if(!empty($request->password)){
      $request->password = Hash::make($request->password);
      $data   = $request->except(['_token','password-confirm']);
    }else {
      $data   = $request->except(['_token','password-confirm','password']);
    }
    User::where('id',$request->id)->update($data);
    return redirect("dashboard/facilitadores/ver/$request->id")->with('success',"Se ha actualizado correctamente");
  }

  /**
  * Deshabilita usuario
  *
  * @param  int  $id
  * @return \Illuminate\Http\Response
  */
  public function delete($id)
  {
    //
  }
}
