<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DiagnosticAnswer extends Model
{
    //
    public $table = 'diagnostic_answers';
    protected $fillable = [
      'user_id',
      'answer_1',
      'answer_2',
      'answer_3',
      'answer_4',
      'answer_5',
    ];


    function user(){
      return $this->belongsTo("App\User");
    }
}
