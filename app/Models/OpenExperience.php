<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OpenExperience extends Model
{
    //
    protected $fillable = ['cv_id', 'from', 'to', 'company', 'city', 'state', 'sector', 'description'];

    public function cv(){
      return $this->belongsTo('App\Models\Cv');
    }
}
