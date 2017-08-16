<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\FacilitatorSurvey;
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

    function count_answers($session_id,$facilitator_id){
      return FacilitatorSurvey::where('session_id',$session_id)->where('facilitator_id',$facilitator_id)->count();

    }



}
