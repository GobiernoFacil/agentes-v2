<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Hash;
use File;

use Mail;
// models
use App\User;
use App\Models\Conversation;
use App\Models\Message;

use App\Models\ModuleSession;
use App\Models\FacilitatorData;
// FormValidators
use App\Http\Requests\SaveMessage;
use App\Http\Requests\SaveSingleMessage;
use App\Models\Image;


class FacilitatorMessages extends Controller
{
  //Paginación
  public $pageSize = 10;

  /**
  * Lista de mensajes de usuario facilitador
  *
  * @return \Illuminate\Http\Response
  */
  public function messages()
  {
    $user 			  = Auth::user();
    $conversations 	  = Conversation::where('user_id',$user->id)->orwhere('to_id',$user->id)->orderBy('created_at','desc')->paginate($this->pageSize);
    return view('facilitator.messages.messages-list')->with([
      "user"      		=> $user,
	  'conversations' =>$conversations,

    ]);
  }
  
  /**
  * Ver mensaje a facilitador @ facilitador
  *
  * @return \Illuminate\Http\Response
  */
  public function viewMessage()
  {
    $user 			  = Auth::user();
    return view('facilitator.messages.message-view')->with([
      "user"      		=> $user,
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
      $users = User::where('type','facilitator')->orwhere('type','fellow')->where('enabled',1)->pluck('name','id');
      return view('facilitator.messages.messages-add')->with([
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
      return redirect("tablero-facilitador/mensajes/ver/$conversation->id")->with('success',"Se ha enviado correctamente");
    }

}
