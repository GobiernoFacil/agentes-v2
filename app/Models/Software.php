<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Software extends Model
{
  protected $fillable = ['cv_id', 'name', 'level'];
    //

  public function cv(){
    return $this->belongsTo('App\Models\Cv');
  }
}
