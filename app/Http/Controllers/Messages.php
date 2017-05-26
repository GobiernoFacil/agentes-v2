<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
// models
use App\Models\Message;
use App\Models\Conversation;
use App\User;
// FormValidators
use App\Http\Requests\SaveMessage;
use App\Http\Requests\SaveSingleMessage;
class Messages extends Controller
{
  //Paginación
  public $pageSize = 10;

    /**
    * Muestra lista de mensajes
    *
    * @return \Illuminate\Http\Response
    */
    public function index()
    {
      //
      $user = Auth::user();
      $conversations = Conversation::where('user_id',$user->id)->orwhere('to_id',$user->id)->orderBy('created_at','desc')->paginate($this->pageSize);
      return view('fellow.messages.messages-list')->with([
        'user' => $user,
        'conversations' =>$conversations,
      ]);

    }

    /**
    * Agregar mensaje
    *
    * @return \Illuminate\Http\Response
    */
    public function add()
    {
      $user   = Auth::user();
      $users = User::where('type','facilitator')->orwhere('type','fellow')->where('enabled',1)->where('id','!=',$user->id)->pluck('name','id');
      return view('fellow.messages.messages-add')->with([
        "user"      => $user,
        'users' => $users
      ]);
    }


    /**
    * Guarda nueva conversación con mensaje
    *
    * @param  \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
    */
    public function save(SaveMessage $request)
    {
      //
      $user   = Auth::user();
      $conversation = new Conversation();
      $conversation->user_id = $user->id;
      $conversation->title   = $request->title;
      $conversation->to_id   = $request->to_id;
      $conversation->save();
      $message = new Message();
      $message->conversation_id = $conversation->id;
      $message->user_id = $user->id;
      $message->to_id   = $request->to_id;
      $message->message = $request->message;
      $message->save();
      return redirect("tablero/mensajes/ver/$conversation->id")->with('success',"Se ha enviado correctamente");
    }

    /**
    * Muestra conversación
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    public function view($conversation_id)
    {
      //
      $user   = Auth::user();
      $conversation = Conversation::where('id',$id)->where('user_id',$user->id)->first();
      if(!$conversation){
      $conversation = Conversation::where('id',$id)->where('to_id',$user->id)->firstOrFail();
      }
      return view('fellow.messages.messages-conversation')->with([
        "user"      => $user,
        "conversation"    => $conversation
      ]);
    }

    /**
    * Agregar mensaje a convesacion
    *
    * @return \Illuminate\Http\Response
    */
    public function addSingle($conversation_id)
    {
      $user   = Auth::user();
      $conversation = Conversation::find($conversation_id);
      return view('fellow.messages.messages-single-add')->with([
        "user"      => $user,
        'conversation' => $conversation
      ]);
    }

    /**
    * Guarda nuevo mensaje en conversacion
    *
    * @param  \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
    */
    public function saveSingle(SaveSingleMessage $request)
    {
      //
      $user   = Auth::user();
      $conversation = Conversation::where('id',$request->conversation_id)->where('user_id',$user->id)->orwhere('to_id',$user->id)->firstOrFail();
      $message = new Message();
      $message->user_id = $user->id;
      if($conversation->to_id != $user->id){
        $message->to_id   = $conversation->to_id;
      }else{
        $message->to_id   = $conversation->user_id;
      }
      $message->conversation_id = $conversation->id;
      $message->message = $request->message;
      $message->save();
      return redirect("tablero/mensajes/ver/$conversation->id")->with('success',"Se ha enviado correctamente");
    }


}
