<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FilesEvaluation extends Model
{
    //
    public $table = 'file_evaluations';
    //user_id = quien evalua, fellow_id = fellow
    protected $fillable = [
        'user_id', 'activity_id','fellow_id','name','score','path','url','comments'
    ];
    //modelos relacionados
  function activity(){
    return $this->belongsTo("App\Models\Activity");
  }

  function user(){
    return $this->belongsTo("App\User",'fellow_id');
  }

}
