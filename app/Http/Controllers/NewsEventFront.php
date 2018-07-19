<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\NewsEvent;
class NewsEventFront extends Controller
{
    //
    //Paginación
    public $pageSize = 10;

    /**
    * Muestra lista de noticias y eventos
    *
    * @return \Illuminate\Http\Response
    */
    public function index()
    {
      $all = NewsEvent::where('public',1)->where('type','!=','notice')->orderBy('created_at','desc')->paginate($this->pageSize);
      return view('frontend.newsEvents.newsEvents-list')->with([
        'all' =>$all,
      ]);

    }

    /**
    * Muestra noticia o evento
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    public function get($slug)
    {
      $content = NewsEvent::where('slug',$slug)->where('public',1)->firstOrFail();
      return view('frontend.newsEvents.newsEvents-view')->with([
        "content"    => $content
      ]);
    }

    /**
    * Muestra noticia o evento
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    public function getFellow($slug)
    {
      $content = NewsEvent::where('slug',$slug)->where('public',1)->firstOrFail();
      return view('frontend.newsEvents.newsEvents-fellow-view')->with([
        "content"    => $content
      ]);
    }

    /**
    * Muestra lista de noticias y eventos
    *
    * @return \Illuminate\Http\Response
    */
    public function fellowIndex()
    {
      $all = NewsEvent::where('public',1)->where('type','fellow')->orderBy('created_at','desc')->paginate($this->pageSize);
      return view('frontend.newsEvents.blog-list')->with([
        'all' =>$all,
      ]);

    }
}
