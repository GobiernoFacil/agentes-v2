<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Notifications\Notifiable;
use Auth;
use Mail;
use App\Notifications\SendNewMessage;
// models
use App\Models\Message;
use App\Models\Conversation;
use App\Models\FacilitatorModule;
use App\Models\StoreConversation;
use App\Models\ConversationLog;

use App\User;
// FormValidators
use App\Http\Requests\SaveMessage;
use App\Http\Requests\SaveSingleMessage;
class Messages extends Controller
{
  //Paginación
  public $pageSize = 10;


      /**
      * Muestra lista de mensajes-archivados
      *
      * @return \Illuminate\Http\Response
      */
      public function indexStoraged()
      {
        //
        $user          = Auth::user();
        $program       = $user->actual_program();
        $conversations = $user->get_storaged_conversations()->paginate($this->pageSize);
        return view('fellow.messages.messages-storage-list')->with([
          'user' => $user,
          'conversations' =>$conversations,
          'program'		=> $program
        ]);

      }

    /**
    * Muestra lista de mensajes
    *
    * @return \Illuminate\Http\Response
    */
    public function index()
    {
      //
      $user = Auth::user();
      $program       = $user->actual_program();
      $conversations = $user->get_conversations()->paginate($this->pageSize);
      return view('fellow.messages.messages-list')->with([
        'user' => $user,
        'conversations' =>$conversations,
        'program'		=> $program
      ]);

    }

    /**
    * Agregar mensaje
    *
    * @return \Illuminate\Http\Response
    */
    public function add()
    {
      $user   	   = Auth::user();
      $program     = $user->actual_program();
      $users       = $user->get_all_users_for_messages();

      return view('fellow.messages.messages-add')->with([
        "user"      => $user,
        'users'     => $users,
        'program'		=> $program
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
      $program      = $user->actual_program();
      $conversation = Conversation::firstOrCreate(['user_id'=>$user->id,'title'=>$request->title,'to_id'=>$request->to_id,"program_id"=>$program->id]);
      $to_user      = User::find($request->to_id);
      $message      = Message::firstOrCreate(['conversation_id'=>$conversation->id,'user_id'=>$user->id,'to_id'=>$request->to_id,'message'=>$request->message]);
      //Guardar log de ultimo mensaje(ultimo que vio)
      $converLog = ConversationLog::firstOrCreate(['user_id'=>$user->id,'conversation_id'=>$conversation->id]);
      $converLog->message_id = $message->id;
      $converLog->status =0;
      $converLog->save();
      //envía correo
      $to_user->notify(new SendNewMessage($user,$to_user,$conversation->id,$program_slug));
      return redirect("tablero/$program->slug/mensajes/ver/$conversation->id")->with('success',"Se ha enviado correctamente");
    }

    /**
    * Muestra conversación
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    public function view($program_slug,$conversation_id)
    {
      $user    = Auth::user();
      $program = $user->actual_program();
      $conversation = Conversation::where('program_id',$program->id)->where('id',$conversation_id)->where('user_id',$user->id)->first();
      if($conversation){
        //determinar dirección de comunicación
        $to_user = $conversation->to_id;
      }else{
        $conversation = Conversation::where('program_id',$program->id)->where('id',$conversation_id)->where('to_id',$user->id)->firstOrFail();
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
      return view('fellow.messages.messages-conversation')->with([
        "user"            => $user,
        "conversation"    => $conversation,
        "program"         => $program
      ]);
    }

    /**
    * Agregar mensaje a convesacion
    *
    * @return \Illuminate\Http\Response
    */
    public function addSingle($program_slug,$conversation_id)
    {
      $user   = Auth::user();
      $program = $user->actual_program();
      $conversation = Conversation::where('program_id',$program->id)->where('id',$conversation_id)->where('user_id',$user->id)->first();
      if(!$conversation){
      $conversation = Conversation::where('program_id',$program->id)->where('id',$conversation_id)->where('to_id',$user->id)->firstOrFail();
      }
      return view('fellow.messages.messages-single-add')->with([
        "user"         => $user,
        'conversation' => $conversation,
        "program"      => $program
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
      $program = $user->actual_program();
      $conversation = Conversation::where('program_id',$program->id)->where('id',$request->conversation_id)->where('user_id',$user->id)->first();
      if(!$conversation){
      $conversation = Conversation::where('program_id',$program->id)->where('id',$request->conversation_id)->where('to_id',$user->id)->firstOrFail();
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
      $to_user->notify(new SendNewMessage($user,$to_user,$conversation->id,$program->slug));
      return redirect("tablero/$program->slug/mensajes/ver/".$conversation->id)->with('success',"Se ha enviado correctamente");
    }

    /**
    * archivar convesacion
    *
    * @return \Illuminate\Http\Response
    */
    public function storage($program_slug,$conversation_id)
    {
      $user   = Auth::user();
      $program = $user->actual_program();
      $conversation = Conversation::where('program_id',$program->id)->where('id',$conversation_id)->where('user_id',$user->id)->first();
      if(!$conversation){
      $conversation = Conversation::where('program_id',$program->id)->where('id',$conversation_id)->where('to_id',$user->id)->firstOrFail();
      }
      $storage = StoreConversation::firstOrCreate(["user_id"=>$user->id,"conversation_id"=>$conversation_id]);
      return redirect("tablero/$program->slug/mensajes")->with("success","Se ha archivado correctamente");
    }



}
