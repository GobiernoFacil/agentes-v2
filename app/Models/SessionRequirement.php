<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SessionRequirement extends Model
{
    //
    protected $fillable = [
        'session_id', 'activity_id','parent_id'
    ];

    function session(){
      return $this->belongsTo("App\Models\ModuleSession");
    }

}
