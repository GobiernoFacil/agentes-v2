<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AspirantInterview extends Model
{
    //
    protected $fillable = [
        'aspirant_id', 'interview_questionnaire_id','user_id','notice_id','type','institution','score'
    ];
}
