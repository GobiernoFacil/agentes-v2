<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ForumMessage extends Model
{
    //
  protected $fillable = [
    'forum_id',
    'user_id',
    'message_id',
    'message',
    'conversation_id'
  ];


  function forum(){
    return $this->belongsTo("App\Models\Forum");
  }
  function conversation(){
    return $this->belongsTo("App\Models\ForumConversation",'conversation_id');
  }
  function user(){
    return $this->belongsTo("App\User");
  }

}
