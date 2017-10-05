<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CustomAnswer extends Model
{
    //
    protected $fillable = [
      'question_id',
      'answer',
      'order',
      'value'
    ];
    //modelos relacionados
    function question(){
      return $this->belongsTo("App\Models\CustomQuestion");
    }
}
