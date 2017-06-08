<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
// models
use App\Models\Message;
use App\Models\Conversation;
use App\Models\FacilitatorModule;
use App\Models\StoreConversation;
use App\User;
// FormValidators
use App\Http\Requests\SaveMessage;
use App\Http\Requests\SaveSingleMessage;
class AdminMessages extends Controller
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
    return view('admin.messages.messages-storage-list')->with([
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
      return view('admin.messages.messages-list')->with([
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
      $users = User::where('type','!=','superAdmin')->where('enabled',1)->orderBy('name','asc')->get();
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

      return view('admin.messages.messages-add')->with([
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
      $conversation->save();
      $message = new Message();
      $message->conversation_id = $conversation->id;
      $message->user_id = $user->id;
      $message->to_id   = $request->to_id;
      $message->message = $request->message;
      $message->save();
      return redirect("dashboard/mensajes/ver/$conversation->id")->with('success',"Se ha enviado correctamente");
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
      return view('admin.messages.messages-conversation')->with([
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
      return view('admin.messages.messages-single-add')->with([
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
      }else{
        $message->to_id   = $conversation->user_id;
      }
      $message->conversation_id = $conversation->id;
      $message->message = $request->message;
      $message->save();
      return redirect("dashboard/mensajes/ver/$conversation->id")->with('success',"Se ha enviado correctamente");
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
      return redirect('dashboard/mensajes')->with("success","Se ha archivado correctamente");
    }



}
