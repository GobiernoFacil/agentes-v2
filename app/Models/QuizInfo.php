<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class QuizInfo extends Model
{
    //
    public $table ="quiz_info";
    protected $fillable = [
        'session_id', 'title', 'description','activity_id'
    ];


  function question(){
    return $this->hasMany("App\Models\Question");
  }
}
