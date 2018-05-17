<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FellowProgram extends Model
{
    //
    protected $fillable = [
        'user_id', 'program_id','notice_id','aspirant_id'
    ];

    function user(){
      return $this->belongsTo("App\User");
    }

    function program_data(){
      return $this->hasOne("App\Models\Program",'program_id');
    }

    function aspirant(){
      return $this->belongsTo("App\Models\Aspirant");
    }
}
