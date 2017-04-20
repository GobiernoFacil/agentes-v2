<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Conversation extends Model
{
    //
    protected $fillable = [
        'title', 'user_id'
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

}
