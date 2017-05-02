<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FacilitatorData extends Model
{
    //
    public $table = 'facilitator_data';
    protected $fillable = [
    'user_id',
    'degree',
    'web',
    'twitter',
    'facebook',
    'linkedin',
    'other',
    'semblance',
    'expert'
    ];
    function user(){
      return $this->belongsTo("App\User");
    }
}
