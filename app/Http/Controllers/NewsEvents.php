<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
// models
use App\Models\NewsEvent;
use App\User;
// FormValidators
use App\Http\Requests\SaveNewsEvents;
use App\Http\Requests\UpdateNewsEvent;
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
    * Muestra noticia o evento
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    public function view($id)
    {
      //
      $user   = Auth::user();
      $content = NewsEvent::find($id);
      return view('admin.newsEvents.NewsEvent-view')->with([
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

    /**
    * Guarda nueva noticia o evento
    *
    * @param  \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
    */
    public function save(SaveNewsEvents $request)
    {
      //
      $user   = Auth::user();
      if($request->type==='news'){
        $data   = $request->except(['start','end','time','_token']);
      }else{
        $data   = $request->except('_token');
      }
      $data['user_id'] = $user->id;
      $data['slug']    = str_slug($request->title);
      $new  = new NewsEvent($data);
      $new->save();
      return redirect("dashboard/noticias-eventos/ver/$new->id")->with('success',"Se ha guardado correctamente");
    }

    /**
    * editar noticia o evento
    *
    * @return \Illuminate\Http\Response
    */
    public function edit($id)
    {
      $user    = Auth::user();
      $content = NewsEvent::where('id',$id)->firstOrFail();
      return view('admin.newsEvents.newsEvents-update')->with([
        "user"      => $user,
        "content"  =>$content
        ]);
    }

    /**
    * Actualiza noticia o evento
    *
    * @param  \Illuminate\Http\Request  $request
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    public function update(UpdateNewsEvent $request)
    {
      //
      if($request->type==='news'){
        $data   = $request->except(['start','end','time','_token']);
      }else{
        $data   = $request->except('_token');
      }
      $data['slug']    = str_slug($request->title);
      NewsEvent::where('id',$request->content_id)->update($data);
      return redirect("dashboard/noticias-eventos/ver/$request->content_id")->with('success',"Se ha actualizado correctamente");
    }

}