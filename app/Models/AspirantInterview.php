<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AspirantInterview extends Model
{
    //
    protected $fillable = [
        'aspirant_id', 'interview_questionnaire_id','user_id','notice_id','type','institution','score'
    ];

    function open_questions(){
       $questions_id = InterviewQuestion::where('interview_questionnaire_id',$this->interview_questionnaire_id)->where('type','open')->pluck('id')->toArray();
       return InterviewAnswer::whereIn('question_id',$questions_id)->where('aspirant_interview_id',$this->id);
    }

    function get_question_data($question_id){
       return InterviewAnswer::where('question_id',$question_id)->where('aspirant_interview_id',$this->id)->first();
    }

}
