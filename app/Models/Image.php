<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    //
    protected $fillable = [
      'user_id',
      'name',
      'type',
      'path',
      'size',
    ];

    function user(){
      return $this->belongsTo("App\User");
    }

}
