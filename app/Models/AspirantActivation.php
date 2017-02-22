<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AspirantActivation extends Model
{
    //
    protected $fillable = [
        'aspirant_id', 'token'
    ];
}
