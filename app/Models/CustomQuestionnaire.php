<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\CustomFellowAnswer;
class CustomQuestionnaire extends Model
{
    //

    protected $fillable = [
      'user_id',
      'title',
      'description',
      'slug',
      'type',
      'activity_id',
      'program_id',
      'facilitator_id'
    ];

    //modelos relacionados
    function questions(){
      return $this->hasMany("App\Models\CustomQuestion",'questionnaire_id');
    }
    function fellow_answers(){
      return $this->hasMany("App\Models\CustomFellowAnswer",'questionnaire_id');
    }

    function facilitator_survey($session_id,$user_id,$facilitator_id){

      return CustomFellowAnswer::where('session_id',$session_id)->where('user_id',$user_id)->where('facilitator_id',$facilitator_id)->first();

    }


    function admin_facilitator_survey($session_id,$facilitator_id){
      return CustomFellowAnswer::where('questionnaire_id',$this->id)->where('session_id',$session_id)->where('facilitator_id',$facilitator_id)->first();

    }
}
