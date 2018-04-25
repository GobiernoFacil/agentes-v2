<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InterviewAnswer extends Model
{
    //

    protected $fillable = [
        'aspirant_interview_id', 'interview_questionnaire_id','question_id','answer'
    ];
}
