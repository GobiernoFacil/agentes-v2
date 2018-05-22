<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Notifications\Notifiable;
use Auth;
use Hash;
use File;
use App\Notifications\SendNewMessage;
use Mail;
// models
use App\User;
use App\Models\Conversation;
use App\Models\ConversationLog;
use App\Models\FacilitatorData;
use App\Models\ModuleSession;
use App\Models\Message;
use App\Models\Program;
use App\Models\StoreConversation;
// FormValidators
use App\Http\Requests\SaveMessage;
use App\Http\Requests\SaveSingleMessage;
use App\Models\Image;


class FacilitatorMessages extends Controller
{
  //Paginación
  public $pageSize = 10;


  /**
   * Muestra lista de programas
   *
   * @return \Illuminate\Http\Response
   */
  public function all()
  {
    $user     = Auth::user();
    $programs = Program::orderBy('start','desc')->paginate($this->pageSize);
    return view('facilitator.messages.messages-program-list')->with([
      "user"      => $user,
      "programs"  => $programs
    ]);
  }

  /**
  * Muestra lista de mensajes-archivados
  *
  * @return \Illuminate\Http\Response
  */
  public function indexStorage()
  {
    //
    $user = Auth::user();
    $storage       = StoreConversation::where('user_id',$user->id)->pluck('conversation_id');
    $conversations = Conversation::where('user_id',$user->id)->whereIn('id',$storage->toArray())->orWhere(function($query)use($storage,$user){
      $query->where('to_id',$user->id)->whereIn('id',$storage->toArray());
    })
    ->orderBy('created_at','desc')->paginate($this->pageSize);
    return view('facilitator.messages.messages-storage-list')->with([
      'user' => $user,
      'conversations' =>$conversations,
    ]);

  }

  /**
  * Lista de mensajes de usuario facilitador
  *
  * @return \Illuminate\Http\Response
  */
  public function messages($program_slug)
  {
    $user 			  = Auth::user();
    $program      = Program::where('slug',$program_slug)->firstOrFail();
    $conversations = $user->get_conversations($program)->paginate($this->pageSize);
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
    if($conversation){
      //determinar dirección de comunicación
      $to_user = $conversation->to_id;
    }else{
      $conversation = Conversation::where('id',$id)->where('to_id',$user->id)->firstOrFail();
      //determinar dirección de comunicación
      $to_user = $conversation->user_id;
    }
    //último mensaje creado por el destinatario
    $last_message = Message::where('conversation_id',$conversation->id)->where('user_id',$to_user)->orderBy('updated_at','desc')->first();
    if($last_message){
      $conversationLog = ConversationLog::where('conversation_id',$conversation->id)->where('message_id',$last_message->id)->where('user_id',$to_user)->first();
      if($conversationLog){
        $conversationLog->status = 1;
        $conversationLog->save();
      }
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
    $to_user = User::find($request->to_id);
    $conversation->save();
    $message = new Message();
    $message->conversation_id = $conversation->id;
    $message->user_id = $user->id;
    $message->to_id   = $request->to_id;
    $message->message = $request->message;
    $message->save();
    //Guardar log de ultimo mensaje(ultimo que vio)
    $converLog = ConversationLog::firstOrCreate(['user_id'=>$user->id,'conversation_id'=>$conversation->id]);
    $converLog->message_id = $message->id;
    $converLog->status =0;
    $converLog->save();
    //envía correo
    $to_user->notify(new SendNewMessage($user,$to_user,$conversation->id));
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
      $to_user          =  User::find($conversation->to_id);
    }else{
      $message->to_id   = $conversation->user_id;
      $to_user          =  User::find($conversation->user_id);
    }
    $message->conversation_id = $conversation->id;
    $message->message = $request->message;
    $message->save();
    //Guardar log de ultimo mensaje(ultimo que vio)
    $converLog = ConversationLog::firstOrCreate(['user_id'=>$user->id,'conversation_id'=>$conversation->id]);
    $converLog->message_id = $message->id;
    $converLog->status =0;
    $converLog->save();
    //envía correo
    $to_user->notify(new SendNewMessage($user,$to_user,$conversation->id));
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
