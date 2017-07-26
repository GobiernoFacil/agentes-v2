<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    //
    protected $fillable = [
        'conversation_id', 'user_id','to_id','message'
    ];

    function conversation(){
      return $this->belongsTo("App\Models\Conversation");
    }
    function user(){
      return $this->belongsTo("App\User");
    }

    function log(){
      return $this->hasOne("App\Models\ConversationLog");
    }
}
