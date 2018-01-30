<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cv extends Model
{
    //
    protected $fillable = ['aspirant_id', 'age', 'phone', 'mobile', 'email','birthdate'];
      //

    public function cv(){
      return $this->belongsTo('App\Models\Student');
    }
    public function academic_trainings(){
      return $this->hasMany('App\Models\AcademicTraining');
    }

    public function experiences(){
      return $this->hasMany('App\Models\Experience');
    }

    public function open_experiences(){
      return $this->hasMany('App\Models\OpenExperience');
    }

    public function further_trainings(){
      return $this->hasMany('App\Models\FurtherTraining');
    }

    public function languages(){
      return $this->hasMany('App\Models\Language');
    }

    public function softwares(){
      return $this->hasMany('App\Models\Software');
    }
}
