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
    'slug',
    'parent_id'
  ];

    //modelos relacionados
  function module(){
    return $this->belongsTo("App\Models\Module");
  }

  function activities(){
    return $this->hasMany("App\Models\Activity",'session_id')->orderBy('updated_at','asc');
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
    return $this->hasMany("App\Models\FacilitatorModule",'session_id');
   }

   function forums(){
     return $this->hasOne("App\Models\Forum",'session_id');
    }



}
