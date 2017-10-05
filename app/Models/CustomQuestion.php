<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CustomQuestion extends Model
{
    //
    protected $fillable = [
      'questionnaire_id',
      'question',
      'type',
      'observations',
      'required',
      'min_label',
      'max_label',
      'options_columns_number',
      'options_rows_number'
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
