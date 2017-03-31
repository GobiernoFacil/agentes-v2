<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class QuizInfo extends Model
{
    //
    protected $fillable = [
        'session_id', 'title', 'description'
    ];


  function question(){
    return $this->hasMany("App\Models\Question");
  }
}
