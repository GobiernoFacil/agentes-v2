<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use File;
// models
use App\Models\NewsEvent;
use App\Models\ImagesNew;
use App\User;
// FormValidators
use App\Http\Requests\SaveNewsEvents;
use App\Http\Requests\UpdateNewsEvent;
class NewsEventsFellow extends Controller
{
    //Paginación
    public $pageSize = 10;
    const UPLOADS = "img/newsEvent";
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
    * Muestra noticia o evento
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    public function view($news_slug)
    {
      //
      $user   = Auth::user();
      $content = NewsEvent::where('slug',$news_slug)->first();
      return view('fellow.news.NewsEvent-view')->with([
        "user"      => $user,
        "content"    => $content
      ]);
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
      $news = NewsEvent::where('public', 1)->orderBy('created_at','desc')->paginate($this->pageSize);
      return view('fellow.news.newsEvents-list')->with([
        'user' => $user,
        'news' =>$news,
      ]);

    }

    



}
