<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Hash;
//Modelos
use App\Models\Module;
//Requests
use App\Http\Requests\UpdateAdminProfile;
class Fellows extends Controller
{
    //

    /**
     * Muestra panel de inicio para fellow
     *
     * @return \Illuminate\Http\Response
     */
    public function dashboard()
    {
      $user 			    = Auth::user();
      $modules        = Module::all();
      return view('fellow.dashboard')->with([
        "user"      		=> $user,
        "modules_count" => $modules->count()
      ]);
    }

    /**
     * Muestra perfil del usuario  fellow
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function viewProfile()
    {
      $user = Auth::user();
      return view('fellow.profile.profile-view')->with([
        "user"      => $user
      ]);
    }

    /**
     * edita perfil del usuario  fellow
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function editProfile()
    {
      $user = Auth::user();
      return view('fellow.profile.profile-update')->with([
        "user"      => $user
      ]);
    }

    /**
     * salva perfil del usuario fellow
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function saveProfile(UpdateAdminProfile $request)
    {
      $user = Auth::user();
      $user->name  = $request->name;
      $user->email = $request->email;

      if(!empty($request->password)){
        $user->password = Hash::make($request->password);
      }
      $user->save();

      return redirect("dashboard/perfil")->with("message",'Perfil actualizado correctamente');
    }
}
