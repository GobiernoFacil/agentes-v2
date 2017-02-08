<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Auth;
use Hash;

// models
use App\User;

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
        //
        $user = Auth::user();
        $list = User::where("type", "suAdmin")->where("id", "!=", $user->id)->paginate($this->pageSize);
        return view('suAdmin.suAdmin-list')->with([
          "user"      => $user,
          "SuAdmins"  => $list]);
    }

    /**
     * Agregar usuario super administrador
     *
     * @return \Illuminate\Http\Response
     */
    public function add()
    {
        //
    }

    /**
     * Guarda nuevo usuario super administrador
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function save(Request $request)
    {
        //
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
