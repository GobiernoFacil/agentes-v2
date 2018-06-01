<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Notifications\Notifiable;
use Auth;
use File;
use App\Notifications\SendNotice;
// models
use App\Models\NewsEvent;
use App\Models\ImagesNew;
use App\Models\Program;
use App\User;
// FormValidators
use App\Http\Requests\SaveNewsEvents;
use App\Http\Requests\UpdateNewsEvent;
class NewsEvents extends Controller
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
    public function view($id)
    {
      //
      $user   = Auth::user();
      $content = NewsEvent::find($id);
      return view('admin.newsEvents.newsEvent-view')->with([
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
      $news = NewsEvent::orderBy('created_at','desc')->paginate($this->pageSize);
      return view('admin.newsEvents.newsEvents-list')->with([
        'user' => $user,
        'news' =>$news,
      ]);

    }

    /**
    * Agregar noticia o evento
    *
    * @return \Illuminate\Http\Response
    */
    public function add()
    {
      $user     = Auth::user();
      $programs = Program::orderBy('start','desc')->pluck('title','id')->toArray();
      $programs[null] = 'Selecciona una opción';
      return view('admin.newsEvents.newsEvents-add')->with([
        "user"      => $user,
        "programs"  => $programs,
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
      $data   = $request->except('_token');
      $data['user_id'] = $user->id;
      $data['slug']    = str_slug($request->title);
      $new  = new NewsEvent($data);
      $new->save();
      // [ SAVE THE IMAGE ]
      if($request->hasFile('image') && $request->file('image')->isValid()){
        $path  = public_path(self::UPLOADS);
        $name = uniqid() . '.' . $request->file('image')->getClientOriginalExtension();
        $request->file('image')->move($path, $name);
        $image   = ImagesNew::firstorCreate(['newsEvents_id'=>$new->id,]);
        $image->name = $name;
        $image->path = $path;
        $image->type = 'full';
        $image->save();
      }
      if($request->type==='notice' && $new->public){
        if($program = Program::where('id',$request->program_id)->first()){
          $fellows = $program->fellows;
          foreach ($fellows as $fellow) {
            //envía correo
            $fellow->user->notify(new SendNotice($fellow->user,$new));
          }
        }

      }
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
      $programs = Program::orderBy('start','desc')->pluck('title','id')->toArray();
      $programs[null] = 'Selecciona una opción';
      return view('admin.newsEvents.newsEvents-update')->with([
        "user"      => $user,
        "content"   =>$content,
        "programs"  => $programs
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
        $data   = $request->except(['start','end','time','_token','image']);
      }else{
        $data   = $request->except('_token','image');
      }
      $data['slug']    = str_slug($request->title);
      NewsEvent::where('id',$request->content_id)->update($data);
      $content = NewsEvent::find($request->content_id);
      // [ SAVE THE IMAGE ]
      if($request->hasFile('image') && $request->file('image')->isValid()){
        $path  = public_path(self::UPLOADS);
        $name = uniqid() . '.' . $request->file('image')->getClientOriginalExtension();
        $request->file('image')->move($path, $name);
        if($content->image){
          File::delete($content->image->path."/".$content->image->name);
        }
        $image   = ImagesNew::firstorCreate(['newsEvents_id'=>$request->content_id]);
        $image->name = $name;
        $image->path = $path;
        $image->type = 'full';
        $image->save();
      }
      return redirect("dashboard/noticias-eventos/ver/$request->content_id")->with('success',"Se ha actualizado correctamente");
    }


    /**
    * Agrega imagen
    *
    * @param  \Illuminate\Http\Request  $request
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    public function uploadImage(Request $request)
    {
      if($request->hasFile('file') && $request->file('file')->isValid()){
        $path  = public_path(self::UPLOADS);
        $name = uniqid() . '.' . $request->file('file')->getClientOriginalExtension();
        $request->file('file')->move($path, $name);
        return response()->JSON([
          'location' => url("/img/NewsEvent/$name")
        ]);
      }
    }

}
