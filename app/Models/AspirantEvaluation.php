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
    'essayGrade',
    'videoGrade',
    'experienceGrade',
    'grade',
    'notice_id',
    'address_proof',
    'institution'
  ];

  //modelos relacionados
  function aspirant(){
    return $this->belongsTo("App\Models\Aspirant");
  }
}
