<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Answer;
class Question extends Model
{
    //
    protected $fillable = [
        'quizInfo_id', 'question', 'type','value','answer_id'
    ];

    //modelos relacionados
    function quizInfo(){
      return $this->belongsTo("App\Models\QuizInfo",'quizInfo_id');
    }

    function answer(){
      return $this->hasMany("App\Models\Answer");
    }

    function correct_Answer($question_id){
      return Answer::where('question_id',$question_id)->where('selected',1)->first();
    }

    function all_correct_Answer($question_id=false){
      return Answer::where('question_id',$this->id)->where('selected',1)->get();
    }

    function count_correct($question_id){
      return Answer::where('question_id',$question_id)->where('selected',1)->count();
    }

    function get_for_fellow_correct_Answer(){
      return Answer::select('value','id')->where('question_id',$this->id)->where('selected',1)->get();
    }
}
