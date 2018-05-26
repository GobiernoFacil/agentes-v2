<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Activity;
use App\Models\ForumLog;
class ModuleSession extends Model
{
    //
protected $fillable = [
    'module_id',
    'order',
    'name',
    'modality',
    'objective',
    'hours',
    'week',
    'comments',
    'start',
    'end',
    'slug',
    'parent_id'
  ];

    //modelos relacionados
  function module(){
    return $this->belongsTo("App\Models\Module");
  }

  function parent(){
    return $this->belongsTo("App\Models\ModuleSession",'parent_id');
  }

  function activities(){
    return $this->hasMany("App\Models\Activity",'session_id')->orderBy('order','asc');
  }

  function topics(){
    return $this->hasMany("App\Models\Topic",'session_id');
  }

  function requirements(){
    return $this->hasMany("App\Models\SessionRequirement",'session_id');
  }

  function evaluations(){
    return $this->hasMany("App\Models\Monitoring",'session_id');
  }

  function facilitators(){
    return $this->hasMany("App\Models\FacilitatorModule",'session_id');
   }

   function forums(){
     return $this->hasOne("App\Models\Forum",'session_id');
    }

  function all_forum(){
    return $this->hasMany("App\Models\Forum",'session_id')->orderBy('created_at','desc');
  }


  function activity_eval($session_id=false){
    return Activity::where('session_id',$this->id)->where('type','evaluation')->orWhere(function($query){
      $query->where('session_id',$this->id)
            ->where('type','diagnostic');
    })->orderBy('end','asc')->get();
  }

  function activity_eval_by_date(){
    $today      = date('Y-m-d');
    $activities = Activity::where('session_id',$this->id)->where('end','<=',$today)->where('type','evaluation')->orWhere(function($query)use($today){
      $query->where('session_id',$this->id)
            ->where('type','diagnostic')
            ->where('end','<=',$today);
    })->orderBy('end','asc')->get();
    return $activities;
  }

  function activity_forum_by_date(){
    $today      = date('Y-m-d');
    $module     = $this->module;
    if($module->end <= $today){
      return Forum::where('session_id',$this->id)->orderBy('end','asc')->get();
    }else{
      //respuesta forzada a cero
      return Forum::where('type','no-one')->get();
    }
  }





  function check_participation($fellow_id,$forum_id){
    if(ForumLog::where('forum_id',$forum_id)->where('user_id',$fellow_id)->where('type','fellow')->first()){
      return true;
    }else{
      return false;
    }

  }



}
