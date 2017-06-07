<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DiagnosticEvaluation extends Model
{
    //

    protected $fillable = [
      'user_id',
      'answer_1',
      'answer_2',
      'answer_3',
      'answer_4',
      'answer_5',
      'answer_ponderation_1',
      'answer_ponderation_2',
      'answer_ponderation_3',
      'answer_ponderation_4',
      'answer_ponderation_5',
      'total_score',
      'answer_q1_1',
      'answer_q1_2',
      'answer_q1_3',
      'answer_q1_j',
      'answer_q2_1',
      'answer_q2_2',
      'answer_q2_j',
      'answer_q3_1',
      'answer_q3_2',
      'answer_q3_3',
      'answer_q3_4',
      'answer_q3_j',
      'answer_q4_1',
      'answer_q4_2',
      'answer_q4_j',
      'answer_q5_1',
      'answer_q5_2',
      'answer_q5_3',
      'answer_q5_j',

    ];

    function user(){
      return $this->belongsTo("App\User");
    }
}
