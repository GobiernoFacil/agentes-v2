<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Auth;
use Hash;

// models
use App\User;

// FormValidators
use App\Http\Requests\SaveSuAdmin;

class SuAdmin extends Controller
{
    //Paginación
    public $pageSize = 10;

    /**
     * Muestra panel de inicio para super administrador
     *
     * @return \Illuminate\Http\Response
     */
    public function dashboard()
    {
      $user = Auth::user();
      return view('suAdmin.dashboard')->with([
        "user"      => $user,]);
    }

    /**
     * Muestra lista de super administradores
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        $list = User::where("type", "suAdmin")->where("id", "!=", $user->id)->paginate($this->pageSize);
        return view('suAdmin.users.suAdmin-list')->with([
          "user"      => $user,
          "suAdmins"  => $list]);
    }

    /**
     * Agregar usuario super administrador
     *
     * @return \Illuminate\Http\Response
     */
    public function add()
    {
      $user = Auth::user();
      return view('suAdmin.users.add-suAdmin')->with([
        "user"      => $user
      ]);

    }

    /**
     * Guarda nuevo usuario super administrador
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function save(SaveSuAdmin $request)
    {
      $suAdmin         = new User();
      $suAdmin->type     = "suAdmin";
      $suAdmin->name     = $request->name;
      $suAdmin->email    = $request->email;
      $suAdmin->password = Hash::make($request->password);
      $suAdmin->save();

      return redirect("sa/dashboard/super-administradores")->with('message','Usuario creado correctamente');
    }

    /**
     * Muestra un usuario super administrador
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function view($id)
    {
        //
    }

    /**
     * Muestra contenido para actualizar usuario super administrador
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Actualiza usuario super administrador
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
     * Deshabilita usuario super administrador
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        //
    }

    /**
     * Muestra perfil del usuario super administrador
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function profile($id)
    {
        //
    }

    /**
     * edita perfil del usuario super administrador
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function editProfile($id)
    {
        //
    }
}
