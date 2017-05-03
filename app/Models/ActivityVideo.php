<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ActivityVideo extends Model
{
    //
    protected $fillable = [
      'activity_id',
      'start',
      'end',
      'time',
      'link'
    ];

    function activity(){
      return $this->belongsTo("App\Models\Activity");
    }

}
