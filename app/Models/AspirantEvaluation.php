<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AspirantEvaluation extends Model
{
    //
    public $table = 'aspirantEvaluation';
    protected $fillable = [
    'aspirant_id',
    'user_id',
    'experience',
    'experience1',
    'experience2',
    'experience3',
    'experienceJ1',
    'experienceJ2',
    'institution',
    'evaluator',
    'essay',
    'essay1',
    'essay2',
    'essay3',
    'essay4',
    'video',
    'video1',
    'video2',
    'video3',
    'video4',
    'essayGrade',
    'videoGrade',
    'experienceGrade',
    'grade'
  ];

  //modelos relacionados
  function aspirant(){
    return $this->belongsTo("App\Models\Aspirant");
  }
}
