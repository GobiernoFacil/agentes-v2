<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AcademicTraining extends Model
{
  protected $fillable = ['cv_id', 'name', 'from', 'to', 'institution', 'city','state'];
    //

  public function cv(){
    return $this->belongsTo('App\Models\Cv');
  }
}
