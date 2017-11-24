<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\Notice;
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
}
