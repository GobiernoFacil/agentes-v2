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
      'evaluation'
    ];

    //modelos relacionados
  function session(){
    return $this->belongsTo("App\Models\ModuleSession");
  }

  function activityRequirements(){
    return $this->hasMany("App\Models\ActivityRequirement");
  }

}
