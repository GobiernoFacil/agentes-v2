<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RetroLog extends Model
{
    //
    protected $fillable = [
         'user_id','status','activity_id'
    ];
}
