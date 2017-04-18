<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Module extends Model
{
    //
    protected $fillable = [
        'title',
        'number_sessions',
        'number_hours',
        'modality',
        'teaching_situation',
        'objective',
        'product_developed',
        'slug',
        'start',
        'end',
        'public',
        'user_id'
    ];

    function sessions(){
      return $this->hasMany("App\Models\ModuleSession")->orderBy('order','asc');
    }

    function facilitators(){
      return $this->hasMany("App\Models\FacilitatorModule");
    }


}
