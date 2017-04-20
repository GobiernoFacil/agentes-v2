<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FacilitatorData extends Model
{
    //

    protected $fillable = [
    'user_id',
    'degree',
    'web',
    'twitter',
    'facebook',
    'linkedin',
    'other',
    'semblance',
    ];
    function user(){
      return $this->belongsTo("App\User");
    }
}
