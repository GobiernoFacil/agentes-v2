<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FellowAnswer extends Model
{
    //
    public $table = 'fellow_answers';
    protected $fillable = [
        'user_id', 'questionInfo_id','question_id','answer_id','correct'
    ];

    function question(){
      return $this->belongsTo("App\Models\Question");
    }

    function quizInfo(){
      return $this->belongsTo("App\Models\quizInfo",'quizInfo_id');
    }


    function user(){
      return $this->belongsTo("App\User");
    }
    function answer(){
      return $this->belongsTo("App\Models\Answer");
    }
}
