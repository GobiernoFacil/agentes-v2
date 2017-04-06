<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Topic extends Model
{
    //

    protected $fillable = [
      'session_id',
      'name',
      'values',
      'knowledge',
      'abilities',
      'products',
    ];

  //modelos relacionados
  function session(){
    return $this->belongsTo("App\Models\ModuleSession");
  }


}
