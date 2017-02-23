<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AspirantsFile extends Model
{
    //
    protected $fillable = [
        'aspirant_id', 'cv', 'essay','video'
    ];

    //modelos relacionados
    function aspirant(){
      return $this->belongsTo("App\Models\Aspirant");
    }
}
