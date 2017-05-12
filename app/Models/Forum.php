<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Forum extends Model
{
    //

    protected $fillable = [
      'session_id',
      'user_id',
      'state_name',
      'topic',
      'description',
      'slug',
    ];

    function session(){
      return $this->belongsTo("App\ModuleSession");
    }

    function forum_messages(){
      return $this->hasMany("App\ForumMessage");
    }


}
