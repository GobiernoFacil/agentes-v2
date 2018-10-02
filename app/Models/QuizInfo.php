<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Answer;
class QuizInfo extends Model
{
    //
    public $table ="quiz_info";
    protected $fillable = [
        'session_id', 'title', 'description','activity_id'
    ];


  function question(){
    return $this->hasMany("App\Models\Question",'quizInfo_id');
  }

  function activity(){
    return $this->belongsTo("App\Models\Activity",'activity_id');
  }

  function answers(){
    $questions = $this->question->pluck('id')->toArray();
    return Answer::whereIn('question_id',$questions)->where('selected',1);
  }
}
