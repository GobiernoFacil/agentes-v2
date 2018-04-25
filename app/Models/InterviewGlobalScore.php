<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InterviewGlobalScore extends Model
{
    //
    protected $fillable = [
        'aspirant_id', 'notice_id','score'
    ];
}
