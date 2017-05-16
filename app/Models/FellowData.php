<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FellowData extends Model
{
    //
    public $table = 'fellow_data';
    protected $fillable = [
    'user_id',
    'degree',
    'origin',
    'state',
    'city',
    'surname',
    'lastname',
    ];

    function user(){
      return $this->belongsTo("App\User");
    }
}
