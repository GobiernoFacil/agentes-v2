<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
// models
use App\Models\NewsEvent;
use App\User;
class NewsEvents extends Controller
{
    //Paginación
    public $pageSize = 10;

    /**
    * Búsqueda de módulo
    *
    * @return \Illuminate\Http\Response
    */
    public function search()
    {
      //
    }

    /**
    * Muestra lista de módulos
    *
    * @return \Illuminate\Http\Response
    */
    public function index()
    {
      //
      $user = Auth::user();
      $all = NewsEvent::orderBy('created_at','desc')->paginate($this->pageSize);
      return view('admin.newsEvents.newsEvents-list')->with([
        'user' => $user,
        'all' =>$all,
      ]);

    }

    /**
    * Agregar noticia o evento
    *
    * @return \Illuminate\Http\Response
    */
    public function add()
    {
      $user   = Auth::user();
      return view('admin.newsEvents.newsEvents-add')->with([
        "user"      => $user,
      ]);
    }

}
