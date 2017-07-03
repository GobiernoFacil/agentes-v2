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
      public function indexStorage()
      {
        //
        $user = Auth::user();
        $storage       = StoreConversation::where('user_id',$user->id)->pluck('conversation_id');
        $conversations = Conversation::where('user_id',$user->id)->whereIn('id',$storage->toArray())->orWhere(function($query)use($storage,$user){
          $query->where('to_id',$user->id)->whereIn('id',$storage->toArray());
        })
        ->orderBy('created_at','desc')->paginate($this->pageSize);
        return view('fellow.messages.messages-storage-list')->with([
          'user' => $user,
          'conversations' =>$conversations,
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
      $storage       = StoreConversation::where('user_id',$user->id)->pluck('conversation_id');
      $conversations = Conversation::where('user_id',$user->id)->whereNotIn('id',$storage->toArray())->orWhere(function($query)use($storage,$user){
        $query->where('to_id',$user->id)->whereNotIn('id',$storage->toArray());
      })
      ->orderBy('created_at','desc')->paginate($this->pageSize);
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
      $assign_users = FacilitatorModule::all()->pluck('user_id');
      $users = User::where('type','facilitator')
      ->orwhere(function($query)use($user){
        $query->where('type','fellow')->where('enabled',1)->where('id','!=',$user->id);
      })
      ->orwhere(function($query)use($assign_users,$user){
        $query->whereIn('id',$assign_users->toArray())->where('enabled',1)->where('id','!=',$user->id);
      })->orderBy('name','asc')->get();
      //->pluck('name','id')
      $names = [];
      foreach ($users as $p) {
        if(isset($p->fellowData)){
          $names[$p->id] = $p->name.' '.$p->fellowData->surname." ".$p->fellowData->lastname;
        }elseif(isset($p->facilitatorData)){
            $names[$p->id] = $p->name.' '.$p->facilitatorData->surname." ".$p->facilitatorData->lastname;
          }else{
            $names[$p->id] = $p->name;
          }
      }

      return view('fellow.messages.messages-add')->with([
        "user"      => $user,
        'users' => $names
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
      //envía correo
      $to_user->notify(new SendNewMessage($user,$to_user,$conversation->id));
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
      $conversation = Conversation::where('id',$conversation_id)->where('user_id',$user->id)->first();
      if(!$conversation){
      $conversation = Conversation::where('id',$conversation_id)->where('to_id',$user->id)->firstOrFail();
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
      $conversation = Conversation::where('id',$conversation_id)->where('user_id',$user->id)->first();
      if(!$conversation){
      $conversation = Conversation::where('id',$conversation_id)->where('to_id',$user->id)->firstOrFail();
      }
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
      $conversation = Conversation::where('id',$request->conversation_id)->where('user_id',$user->id)->first();
      if(!$conversation){
      $conversation = Conversation::where('id',$request->conversation_id)->where('to_id',$user->id)->firstOrFail();
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
     //envía correo
      $to_user->notify(new SendNewMessage($user,$to_user,$conversation->id));
      return redirect("tablero/mensajes/ver/$conversation->id")->with('success',"Se ha enviado correctamente");
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
      return redirect('tablero/mensajes')->with("success","Se ha archivado correctamente");
    }



}
