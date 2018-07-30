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
      return $this->belongsTo("App\Models\CustomQuestionnaire",'questionnaire_id');
    }

    function answers(){
      return $this->hasMany("App\Models\CustomAnswer",'question_id');
    }
    function answers_fellows(){
      return $this->hasMany("App\Models\CustomFellowAnswer",'question_id')->where('user_id','!=',23);
    }

    function data_to_graph(){
      $temp = [];
      for ($i=1; $i <= $this->options_columns_number ; $i++) {
        $value  = CustomFellowAnswer::where('question_id',$this->id)->where('user_id','!=',23)->where('answer',$i)->count();
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

    function data_to_graph_facilitator($session_id,$facilitator_id){
      $temp = [];
      for ($i=1; $i <= $this->options_columns_number ; $i++) {
        $value  = CustomFellowAnswer::where('question_id',$this->id)->where('session_id',$session_id)->where('facilitator_id',$facilitator_id)->where('answer',$i)->count();
        $temp[] = [
            'options' => $i,
            'values'  => $value
          ];

      }
      return $temp;
    }

    function data_to_graph_rows_facilitator($answer_id,$session_id,$facilitator_id){
      $temp = [];
      for ($i=1; $i <= $this->options_columns_number ; $i++) {
        $value  = CustomFellowAnswer::where('question_id',$this->id)->where('answer',$i)->where('session_id',$session_id)->where('facilitator_id',$facilitator_id)->where('answer_id',$answer_id)->count();
        $temp[] = [
            'options' => $i,
            'values'  => $value
          ];

      }
      return $temp;
    }

    function answers_fellows_facilitator($session_id,$facilitator_id){
      return CustomFellowAnswer::where('question_id',$this->id)->where('session_id',$session_id)->where('facilitator_id',$facilitator_id)->get();
    }

    function correct_Answer($question_id){
      return CustomAnswer::where('question_id',$question_id)->where('selected',1)->first();
    }

    function count_correct($question_id){
      return CustomAnswer::where('question_id',$question_id)->where('selected',1)->count();
    }

    function get_open_fellow_answer($fellow_id){
       return CustomFellowAnswer::where('user_id',$fellow_id)->where('question_id',$this->id)->first();
    }
}
