<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\FellowScore;
class Activity extends Model
{
    //

    protected $fillable = [
      'session_id',
      'order',
      'name',
      'description',
      'facilitator_role',
      'competitor_role',
      'duration',
      'slug',
      'type',
      'files',
      'evaluation',
      'hasfiles',
      'hasforum',
      'end'
    ];

    //modelos relacionados
  function session(){
    return $this->belongsTo("App\Models\ModuleSession");
  }

  function activityRequirements(){
    return $this->hasMany("App\Models\ActivityRequirement");
  }

  function activityFiles(){
    return $this->hasMany("App\Models\ActivitiesFile");
  }

  function videos(){
    return $this->hasOne("App\Models\ActivityVideo");
  }

  function forum(){
    return $this->hasOne("App\Models\Forum");
  }

  function quizInfo(){
    return $this->hasOne("App\Models\QuizInfo");
  }

  function fellowScore($questionInfo_id,$user_id){
    return FellowScore::where('questionInfo_id',$questionInfo_id)->where('user_id',$user_id)->first();
  }

}
