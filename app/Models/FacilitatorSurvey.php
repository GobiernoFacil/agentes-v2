<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FacilitatorSurvey extends Model
{
    //
    public $table = 'survey_facilitators';

protected $fillable = [
    'user_id',
    'session_id',
    'facilitator_id',
    'fa_1',
    'fa_2',
    'fa_3',
    'fa_4',
    'fa_5',
    'fa_6',
    'fa_7',
    'fa_8',
    'fa_9',
  ];
}
