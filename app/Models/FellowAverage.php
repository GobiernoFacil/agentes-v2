<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FellowAverage extends Model
{
    //
    public $table = 'fellow_averages';
    protected $fillable = [
    'user_id',
    'module_id',
    'session_id',
    'type',
    'average',
    ];
}
