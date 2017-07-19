<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ForumLog extends Model
{
    //
    protected $fillable = [
      'forum_id',
      'user_id',
      'message_id',
      'conversation_id',
      'action',
      'type'
    ];

}
