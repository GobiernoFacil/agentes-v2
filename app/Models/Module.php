<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\ModuleSession;
use App\Models\Activity;
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
        'user_id',
        'program_id',
        'measure',
        'parent_id'
    ];

    function program(){
      return $this->belongsTo("App\Models\Program");
    }

    function sessions(){
      return $this->hasMany("App\Models\ModuleSession")->orderBy('order','asc');
    }

    function facilitators(){
      return $this->hasMany("App\Models\FacilitatorModule");
    }


    function check_last_activity($module_id){
      $today = date('Y-m-d');
      //ultima sesion del modulo
       $last_session = ModuleSession::where('module_id',$module_id)->orderBy('start','desc')->first();
       if($last_session){
          $last_activity = Activity::where('session_id',$last_session->id)->orderBy('end','desc')->first();
          if($last_activity){
            if($last_activity->type ==='evaluation'){
              //sesion con actividades de evaluacion, si la fecha de cierre termino, el modulo se toma en cuenta
              if($last_activity->end <= $today){
                return true;
              }else{
                return false;
              }

            }else{
              //sesion sin actividades de evaluacion, si ya inicio, se checa si el modulo cuenta con sesiones que contentan actividades para evaluar o foros
              if($last_session->start <= $today){
                $sessions_id = ModuleSession::where('module_id',$module_id)->pluck('id');
                $ev_act      = Activity::where('type','evaluation')->whereIn('session_id',$sessions_id->toArray())->count();
                $forums      = Forum::whereIn('session_id',$sessions_id->toArray())->count();
                if($ev_act>0 ||   $forums>0 ){
                  return true;
                }else{
                  return false;
                }
              }else{
                return false;
              }
            }
          }else{
            //sesion sin actividades, si ya inicio, se checa si el modulo cuenta con sesiones que contentan actividades para evaluar o foros
            if($last_session->start <= $today){
              $sessions_id = ModuleSession::where('module_id',$module_id)->pluck('id');
              $ev_act      = Activity::where('type','evaluation')->whereIn('session_id',$sessions_id->toArray())->count();
              $forums      = Forum::whereIn('session_id',$sessions_id->toArray())->count();
              if($ev_act>0 ||   $forums>0 ){
                return true;
              }else{
                return false;
              }
            }else{
              return false;
            }
          }

       }else{
         //no se toma en cuenta
         return false;
       }
    }


}
