<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FellowProgram extends Model
{
    //
    protected $fillable = [
        'user_id', 'program_id'
    ];

    function user(){
      return $this->belongsTo("App\User");
    }

    function program(){
      return $this->hasOne("App\Models\Program",'program_id');
    }
}
