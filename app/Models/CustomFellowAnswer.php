<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CustomFellowAnswer extends Model
{
    //

    protected $fillable = [
      'user_id',
      'questionnaire_id',
      'question_id',
      'answer'
    ];

    //modelos relacionados
    function questionnaire(){
      return $this->belongsTo("App\Models\CustomQuestionnarie");
    }

    function question(){
      return $this->belongsTo("App\Models\CustomQuestion",'question_id');
    }

    function user(){
      return $this->belongsTo("App\User");
    }
}
