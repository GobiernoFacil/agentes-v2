<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CustomQuestion extends Model
{
    //
    protected $fillable = [
      'questionnaire_id',
      'question',
      'type'
    ];

    //modelos relacionados
    function questionnaire(){
      return $this->belongsTo("App\Models\CustomQuestionnarie",'questionnaire_id');
    }

    function answers(){
      return $this->hasMany("App\Models\CustomAnswer",'question_id');
    }
    function answers_fellows(){
      return $this->hasMany("App\Models\CustomFellowAnswer",'question_id');
    }
}
