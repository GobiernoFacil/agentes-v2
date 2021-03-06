<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InterviewQuestionnaire extends Model
{
    //
    protected $fillable = [
         'notice_id','title','description'
    ];

    function questions(){
      return $this->hasMany("App\Models\InterviewQuestion",'interview_questionnaire_id');
    }

}
