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
use App\Models\StoreConversation;
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
    $storage       = StoreConversation::where('user_id',$user->id)->pluck('conversation_id');
    $conversations = Conversation::where('user_id',$user->id)->whereNotIn('id',$storage->toArray())->orWhere(function($query)use($storage,$user){
      $query->where('to_id',$user->id)->whereNotIn('id',$storage->toArray());
    })
    ->orderBy('created_at','desc')->paginate($this->pageSize);

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
  public function viewMessage($id)
  {
    $user 			  = Auth::user();
    $conversation = Conversation::where('id',$id)->where('user_id',$user->id)->first();
    if(!$conversation){
    $conversation = Conversation::where('id',$id)->where('to_id',$user->id)->firstOrFail();
    }
     return view('facilitator.messages.messages-conversation')->with([
      "user"      		=> $user,
      "conversation"  => $conversation
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

    /**
    * Agregar mensaje a convesacion
    *
    * @return \Illuminate\Http\Response
    */
    public function addSingle($conversation_id)
    {
      $user   = Auth::user();
      $conversation = Conversation::where('id',$conversation_id)->where('user_id',$user->id)->first();
      if(!$conversation){
      $conversation = Conversation::where('id',$conversation_id)->where('to_id',$user->id)->firstOrFail();
      }
      return view('facilitator.messages.messages-single-add')->with([
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
      $conversation = Conversation::where('id',$request->id)->where('user_id',$user->id)->first();
      if(!$conversation){
      $conversation = Conversation::where('id',$request->id)->where('to_id',$user->id)->firstOrFail();
      }
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
      return redirect("tablero-facilitador/mensajes/ver/$conversation->id")->with('success',"Se ha enviado correctamente");
    }

    /**
    * archivar convesacion
    *
    * @return \Illuminate\Http\Response
    */
    public function storage($conversation_id)
    {
      $user   = Auth::user();
      $conversation = Conversation::where('id',$conversation_id)->where('user_id',$user->id)->first();
      if(!$conversation){
      $conversation = Conversation::where('id',$conversation_id)->where('to_id',$user->id)->firstOrFail();
      }
      $storage = StoreConversation::firstOrCreate(["user_id"=>$user->id,"conversation_id"=>$conversation_id]);
      return redirect('tablero-facilitador/mensajes')->with("success","Se ha archivado correctamente");
    }

}
