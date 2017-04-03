<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Module extends Model
{
    //
    protected $fillable = [
        'title',
        'number_sessions',
        'number_hours',
        'modality',
        'teaching_situation',
        'objective',
        'product_developed',
        'slug',
        'start',
        'end',
        'public',
        'user_id'
    ];



}
