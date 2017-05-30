<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StoreConversation extends Model
{
    //
    protected $fillable = [
         'user_id','conversation_id'
    ];

    function user(){
      return $this->belongsTo("App\User");
    }

    function conversation(){
      return $this->belongsTo("App\Conversation");
    }
}
