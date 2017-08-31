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
      return $this->belongsTo("App\Models\CustomQuestionnarie");
    }

    function answers(){
      return $this->hasMany("App\Models\CustomAnswer");
    }
}
