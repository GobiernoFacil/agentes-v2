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
      return $this->belongsTo("App\Models\ModuleSession");
    }

    function forum_messages(){
      return $this->hasMany("App\Models\ForumMessage");
    }

    function activity(){
      return $this->belongsTo("App\Models\Activity");
    }

    function user(){
      return $this->belongsTo("App\User");
    }



}
