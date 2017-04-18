<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ModuleSession extends Model
{
    //
protected $fillable = [
    'module_id',
    'order',
    'name',
    'modality',
    'objective',
    'hours',
    'week',
    'comments',
    'start',
    'end',
    'slug'
  ];

    //modelos relacionados
  function module(){
    return $this->belongsTo("App\Models\Module");
  }

  function activities(){
    return $this->hasMany("App\Models\Activity",'session_id');
  }

  function topics(){
    return $this->hasMany("App\Models\Topic",'session_id');
  }

  function requirements(){
    return $this->hasMany("App\Models\SessionRequirement",'session_id');
  }

  function evaluations(){
    return $this->hasMany("App\Models\Monitoring",'session_id');
  }

  function facilitators(){
    return $this->hasMany("App\Models\FacilitatorModule");
  }


}
