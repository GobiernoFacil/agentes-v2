<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    //
    protected $fillable = [
        'quizInfo_id', 'question', 'type','value'
    ];

    //modelos relacionados
    function quizInfo(){
      return $this->belongsTo("App\Models\QuizInfo");
    }

    function answer(){
      return $this->hasMany("App\Models\Answer");
    }
}
