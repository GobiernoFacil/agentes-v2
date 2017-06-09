<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

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
      'hasforum'
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

}
