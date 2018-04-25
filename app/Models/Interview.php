<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Interview extends Model
{
    //
    protected $fillable = [
        'aspirant_id', 'notice_id','type','institution'
    ];

    function aspirant(){
      return $this->belongsTo("App\Models\Aspirant");
    }
}
