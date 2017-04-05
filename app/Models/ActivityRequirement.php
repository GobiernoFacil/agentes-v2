<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ActivityRequirement extends Model
{
    //

    protected $fillable = [
      'activity_id',
      'order',
      'name',
      'description',
      'material_link',
    ];

    //modelos relacionados
  function activities(){
    return $this->belongsTo("App\Models\Activity");
  }
}
