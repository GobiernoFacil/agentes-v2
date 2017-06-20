<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FellowAnswer extends Model
{
    //
    public $table = 'fellow_answers';
    protected $fillable = [
        'user_id', 'questionInfo_id','question_id','answer_id','correct'
    ];
}
