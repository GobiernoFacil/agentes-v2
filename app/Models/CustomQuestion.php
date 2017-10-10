<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\CustomFellowAnswer;
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

    function data_to_graph(){
      $temp = [];
      for ($i=1; $i <= $this->options_columns_number ; $i++) {
        $value  = CustomFellowAnswer::where('question_id',$this->id)->where('answer',$i)->count();
        $temp[] = [
            'options' => $i,
            'values'  => $value
          ];

      }
      return $temp;
    }

    function data_to_graph_rows($answer_id){
      $temp = [];
      for ($i=1; $i <= $this->options_columns_number ; $i++) {
        $value  = CustomFellowAnswer::where('question_id',$this->id)->where('answer',$i)->where('answer_id',$answer_id)->count();
        $temp[] = [
            'options' => $i,
            'values'  => $value
          ];

      }
      return $temp;
    }
}
