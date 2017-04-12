<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Auth;
use Hash;

use Mail;

// models
use App\User;
use App\Models\Aspirant;

// FormValidators
use App\Http\Requests\SaveAdmin;
use App\Http\Requests\UpdateAdmin;
use App\Http\Requests\UpdateAdminProfile;
class Admin extends Controller
{

  //Paginación
  public $pageSize = 10;

      /**
       * Muestra panel de inicio para administrador
       *
       * @return \Illuminate\Http\Response
       */
      public function dashboard()
      {
        $user 			  = Auth::user();
        $aspirants 		  = Aspirant::where('is_activated',1)->count();
		$chihuahua_number = Aspirant::where('is_activated',1)->where('state','Chihuahua')->count();
		$morelos_number   = Aspirant::where('is_activated',1)->where('state','Morelos')->count();
		$leon_number 	  = Aspirant::where('is_activated',1)->where('state','Nuevo Léon')->count();
		$oaxaca_number 	  = Aspirant::where('is_activated',1)->where('state','Oaxaca')->count();
		$sonora_number 	  = Aspirant::where('is_activated',1)->where('state','Sonora')->count();

        return view('admin.dashboard')->with([
          "user"      		=> $user,
          "aspirants"		=> $aspirants,
		  'chihuahua_number'=> $chihuahua_number,
		  'morelos_number' 	=> $morelos_number,
		  'leon_number' 	=> $leon_number,
		  'oaxaca_number' 	=> $oaxaca_number,
		  'sonora_number' 	=> $sonora_number
        ]);
      }

      /**
       * Muestra lista de administradores
       *
       * @return \Illuminate\Http\Response
       */
      public function index()
      {
        $user = Auth::user();
        $list = User::where("type", "admin")->paginate($this->pageSize);
        return view('suAdmin.users.admin-list')->with([
          "user"      => $user,
          "admins"  => $list]);
      }

      /**
       * Agregar usuario administrador
       *
       * @return \Illuminate\Http\Response
       */
      public function add()
      {
        $user = Auth::user();
        return view('suAdmin.users.admin-add')->with([
          "user"      => $user
        ]);
      }

      /**
       * Guarda nuevo usuario administrador
       *
       * @param  \Illuminate\Http\Request  $request
       * @return \Illuminate\Http\Response
       */
      public function save(SaveAdmin $request)
      {
        $admin           = new User();
        $admin->type     = "admin";
        $admin->name     = $request->name;
        $admin->email    = $request->email;
        $admin->institution    = $request->institution;
        $admin->enabled  = 1;
        $admin->password = Hash::make($request->password);
        $admin->save();
        //envía correo
        $from    = "info@apertus.org.mx";
        $subject = "Bienvenido al Programa de Formación de Agentes Locales de Cambio en Gobierno Abierto y Desarrollo Sostenible";
       //enviar correo para confirmar dirección de correo
        Mail::send('emails.new_user', ['user' => $admin,'request'=>$request], function($message) use ($admin,$from, $subject) {
                $message->from($from, 'no-reply');
                $message->to($admin->email);
                $message->subject($from);
        });


        return redirect("sa/dashboard/administradores/ver/$admin->id")->with('message','Usuario creado correctamente');
      }

      /**
       * Muestra un usuario administrador
       *
       * @param  int  $id
       * @return \Illuminate\Http\Response
       */
      public function view($id)
      {
        $user  = Auth::user();
        $admin = User::find($id);

        return view("suAdmin.users.admin-profile")->with([
          "user"  => $user,
          "admin" => $admin
        ]);
      }

      /**
       * Muestra contenido para actualizar usuario administrador
       *
       * @param  int  $id
       * @return \Illuminate\Http\Response
       */
      public function edit($id)
      {
        $user  = Auth::user();
        $admin = User::find($id);

        return view("suAdmin.users.admin-update")->with([
          "user"  => $user,
          "admin" => $admin
        ]);

      }

      /**
       * Actualiza usuario administrador
       *
       * @param  \Illuminate\Http\Request  $request
       * @param  int  $id
       * @return \Illuminate\Http\Response
       */
      public function update(UpdateAdmin $request, $id)
      {
        $admin        = User::find($id);
        $admin->name  = $request->name;
        $admin->email = $request->email;
        $admin->institution    = $request->institution;

        if(!empty($request->password)){
          $admin->password = Hash::make($request->password);
        }
        $admin->save();

        return redirect("sa/dashboard/administradores/ver/$id")->with("message",'Usuario actualizado correctamente');
      }

      /**
       * Deshabilita usuario administrador
       *
       * @param  int  $id
       * @return \Illuminate\Http\Response
       */
      public function delete($id)
      {
        $admin        = User::find($id);
        $admin->enabled  = 0;
        $admin->save();

        return redirect("sa/dashboard/administradores/ver/$id")->with("message",'Usuario deshabilitado');
      }

      /**
       * Muestra perfil del usuario  administrador
       *
       * @param  int  $id
       * @return \Illuminate\Http\Response
       */
      public function viewProfile()
      {
        $user = Auth::user();
        return view('admin.profile.profile-view')->with([
          "user"      => $user
        ]);
      }

      /**
       * edita perfil del usuario  administrador
       *
       * @param  int  $id
       * @return \Illuminate\Http\Response
       */
      public function editProfile()
      {
        $user = Auth::user();
        return view('admin.profile.profile-update')->with([
          "user"      => $user
        ]);
      }

      /**
       * salva perfil del usuario administrador
       *
       * @param  int  $id
       * @return \Illuminate\Http\Response
       */
      public function saveProfile(UpdateAdminProfile $request)
      {
        $admin = Auth::user();
        $admin->name  = $request->name;
        $admin->email = $request->email;

        if(!empty($request->password)){
          $admin->password = Hash::make($request->password);
        }
        $admin->save();

        return redirect("dashboard/perfil")->with("message",'Perfil actualizado correctamente');
      }
}
