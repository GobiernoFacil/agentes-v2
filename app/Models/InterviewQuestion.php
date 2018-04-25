<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InterviewQuestion extends Model
{
    //
    protected $fillable = [
      'interview_questionnaire_id',
      'question',
      'required',
      'options_rows_number',
      'type',
      'options_columns_number',
      'min_label',
      'max_label',
      'observations'
    ];
}
