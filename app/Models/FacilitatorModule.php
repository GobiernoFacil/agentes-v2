<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FacilitatorModule extends Model
{
    //
    protected $fillable = [
        'user_id', 'module_id','session_id'
    ];

    //modelos relacionados
    function user(){
      return $this->belongsTo("App\User");
    }

    //modelos relacionados
    function session(){
      return $this->belongsTo("App\Models\ModuleSession",'session_id');
    }

}
