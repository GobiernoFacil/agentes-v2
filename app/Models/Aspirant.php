<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Aspirant extends Model
{
    //
    protected $fillable = [
        'name', 'surname', 'lastname','email','city','state','degree'
    ];

    //modelos relacionados
  function AspirantsFile(){
    return $this->hasOne("App\Models\AspirantsFile");
  }
}
