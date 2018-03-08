<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AspirantGlobalGrade extends Model
{
    //
    public $table = 'aspirants_global_grades';
    protected $fillable = ['aspirant_id', 'notice_id','grade'];

    //modelos relacionados
    function aspirant(){
      return $this->belongsTo("App\Models\Aspirant",'aspirant_id');
    }

    function notice(){
      return $this->belongsTo("App\Models\Aspirant",'notice_id');
    }
}
