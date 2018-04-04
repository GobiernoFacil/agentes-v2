<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Log extends Model
{
    //
    protected $fillable = [
        'session_id', 'user_id','module_id','type','activity_id','program_id'
    ];

    function fellow(){
      return $this->belongsTo("App\User");
    }

    function activity(){
      return $this->belongsTo("App\Models\Activity",'activity_id');
    }
}
