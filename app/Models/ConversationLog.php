<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ConversationLog extends Model
{
    //
    protected $fillable = [
        'user_id', 'conversation_id','message_id','status'
    ];

    function conversation(){
      return $this->belongsTo("App\Models\Conversation");
    }

    function message(){
      return $this->belongsTo("App\Models\Message");
    }

}
