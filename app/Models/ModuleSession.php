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


}
