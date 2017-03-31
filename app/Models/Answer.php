<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    //
    //
    protected $fillable = [
        'question_id', 'type','value'
    ];

    //modelos relacionados
    function question(){
      return $this->belongsTo("App\Models\Question");
    }


}
