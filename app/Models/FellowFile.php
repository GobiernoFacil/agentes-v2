<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FellowFile extends Model
{
    //
    public $table = 'fellow_files';
    protected $fillable = [
        'user_id', 'activity_id','description','name','path'
    ];

    function user(){
      return $this->belongsTo("App\User");
    }
}
