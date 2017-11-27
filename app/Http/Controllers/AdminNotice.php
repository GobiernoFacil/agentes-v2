<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\Notice;
//Request validations
use App\Http\Requests\SaveAdminNotice;
class AdminNotice extends Controller
{
    //
    /**
     * Muestra lista de convocatorias
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $user    = Auth::user();
        $notices = Notice::orderBy('start','desc')->get();
        return view('admin.notices.list-view')->with([
          'user'    => $user,
          'notices' => $notices
        ]);
    }

    /**
     * Muestra formulario para agregar convocatoria
     *
     * @return \Illuminate\Http\Response
     */
    public function add()
    {
        //
        $user    = Auth::user();
        return view('admin.notices.notice-add')->with([
          'user'    => $user,
        ]);
    }

    /**
     * Guarda  convocatoria
     *
     * @return \Illuminate\Http\Response
     */
    public function save(SaveAdminNotice $request)
    {
      $user    = Auth::user();
      $notice  = new Notice($request->except(['_token','hasfiles']));
      $notice->user_id = $user->id;
      $notice->save();
      //convocatoria contiene archivos para descargar
      if($request->hasfiles === 'Sí'){
        return redirect('dashboard/convocatorias/agregar-archivos/'.$notice->id);
      }else{
        return redirect('dashboard/convocatorias')->with(['message'=>'Se ha guardado correctamente']);
      }

    }

    /**
     * Muestra formulario para agregar archivos a convocatoria
     *
     * @return \Illuminate\Http\Response
     */
    public function addFiles($id)
    {
        //
        $user    = Auth::user();
        return view('admin.notices.notice-add')->with([
          'user'    => $user,
        ]);
    }

}
