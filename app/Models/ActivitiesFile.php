<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ActivitiesFile extends Model
{
    //

    protected $fillable = [
      'activity_id',
      'name',
      'description',
      'path',
    ];

    function activity(){
      return $this->belongsTo("App\Models\Activity");
    }
}
