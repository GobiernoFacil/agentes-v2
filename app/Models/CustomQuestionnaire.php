<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CustomQuestionnaire extends Model
{
    //

    protected $fillable = [
      'user_id',
      'title',
      'description',
      'slug'
    ];

    //modelos relacionados
    function questions(){
      return $this->hasMany("App\Models\CustomQuestion");
    }
}
