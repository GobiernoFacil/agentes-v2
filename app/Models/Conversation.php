<?php

namespace App\Models;
use App\User;
use App\Models\ConversationLog;
use Illuminate\Database\Eloquent\Model;

class Conversation extends Model
{
    //
    protected $fillable = [
        'title', 'user_id','to_id','program_id'
    ];

    function user(){
      return $this->belongsTo("App\User");
    }

    function user_to(){
      return $this->belongsTo("App\User",'to_id');
    }

    function messages(){
      return $this->hasMany("App\Models\Message");
    }

    function store_conversations(){
      return $this->hasMany("App\Models\StoreConversation");
    }

    function last_message(){
      return $this->hasMany("App\Models\Message")->orderBy('created_at','desc');
    }

    function get_no_messages($user_id){
        $user     = User::find($user_id);
        $con_id   = $user->conversations->pluck('id');
        $con_2_id = Conversation::where('to_id',$user_id)->pluck('id');
        $temp     = array_unique(array_merge($con_id->toArray(),$con_2_id->toArray()));
        $conversations = ConversationLog::where('status',0)->whereIn('conversation_id',$temp)->orderBy('created_at','asc')->get();
        return $conversations;


    }



}
