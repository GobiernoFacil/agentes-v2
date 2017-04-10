<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Monitoring extends Model
{
    //
    public $table = 'monitoring';
    protected $fillable = [
        'session_id',
        'knowledge',
        'role',
        'competitions',
        'jewel',
        'attitude'
      ];

      function session(){
        return $this->belongsTo("App\Models\ModuleSession");
      }

}
