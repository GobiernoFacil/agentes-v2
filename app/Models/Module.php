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

    function unique_facilitators(){
      return $this->hasMany("App\Models\FacilitatorModule")->select('user_id')->groupBy('user_id');
    }

    function parent(){
      return Module::where('id',$this->parent_id)->first();
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

    function duration_hours(){
      $sessions  = $this->sessions->pluck('id')->toArray();
      $hours   = Activity::whereIn('session_id',$sessions)->where('measure',1)->sum('duration');
      $minutes = Activity::whereIn('session_id',$sessions)->where('measure',0)->sum('duration');
      $conver  = $minutes/60;
      return $hours+$conver;
    }

    function duration_minutes(){
      $sessions  = $this->sessions->pluck('id')->toArray();
      $hours   = Activity::whereIn('session_id',$sessions)->where('measure',1)->sum('duration');
      $minutes = Activity::whereIn('session_id',$sessions)->where('measure',0)->sum('duration');
      $conver  = $hours*60;
      return $minutes+$conver;
    }

    function duration_activities($type,$measure){
      $sessions  = $this->sessions->pluck('id')->toArray();
      $hours   = Activity::whereIn('session_id',$sessions)->where('measure',1)->where('type',$type)->sum('duration');
      $minutes = Activity::whereIn('session_id',$sessions)->where('measure',0)->where('type',$type)->sum('duration');
      if($measure){
        //horas
        $conver  = $minutes/60;
        $time    = $hours+$conver;
      }else{
        //minutos
        $conver  = $hours*60;
        $time    = $minutes+$conver;
      }
      return $time;
    }

    function count_activities($type){
      $sessions  = $this->sessions->pluck('id')->toArray();
      return  Activity::whereIn('session_id',$sessions)->where('type',$type)->count();
    }

    function get_evaluation_activity(){
      $sessions  = $this->sessions->pluck('id')->toArray();
      return  Activity::whereIn('session_id',$sessions)->where('type','evaluation')->first();
    }


    function get_all_evaluation_activity(){
      $sessions  = $this->sessions->pluck('id')->toArray();
      return  Activity::whereIn('session_id',$sessions)->where('type','evaluation')->orWhere(function($query) use($sessions){
                $query->whereIn('session_id',$sessions)
                      ->where('type','diagnostic');
            })->get();
    }

    function get_all_evaluation_activity_and_forum(){
      $sessions  = $this->sessions->pluck('id')->toArray();
      return  Activity::whereIn('session_id',$sessions)->where('type','evaluation')
      ->orWhere(function($query) use($sessions){
                $query->whereIn('session_id',$sessions)
                      ->where('type','diagnostic');
      })
      ->orWhere(function($query) use($sessions){
                $query->whereIn('session_id',$sessions)
                      ->where('hasforum',1);
      })->orderBy('order','asc')
      ->get();
    }

    function get_evaluation_activity_kardex(){
      $sessions  = $this->sessions->pluck('id')->toArray();
      $forum_act = $this->get_all_activities_with_forums()->pluck('id')->toArray();
      return  Activity::whereIn('session_id',$sessions)->where('type','evaluation')
      ->orWhere(function($query)use($forum_act){
        $query->whereIn('id',$forum_act);
      })
      ->get();
    }

    function get_all_activities_with_forums(){
      $sessions  = $this->sessions->pluck('id')->toArray();
      return  Activity::whereIn('session_id',$sessions)->where('hasforum',1)->get();
    }

    function get_all_evaluation_activity_by_date(){
      $today     = date('Y-m-d');
      $sessions  = $this->sessions->pluck('id')->toArray();
      return  Activity::whereIn('session_id',$sessions)->where('end','<=',$today)->where('type','evaluation')->orWhere(function($query) use($sessions,$today){
                $query->whereIn('session_id',$sessions)
                      ->where('type','diagnostic')
                      ->where('end','<=',$today);
            })->get();
    }

    function all_activities(){
      $sessions  = $this->sessions->pluck('id')->toArray();
      return  Activity::whereIn('session_id',$sessions);

    }




    function get_diagnostc_activities(){
      $sessions  = $this->sessions->pluck('id')->toArray();
      return  Activity::whereIn('session_id',$sessions)->where('type','diagnostic')->orderBy('end','asc');
    }

    function fellow_act_forums(){
      $sessions_id   = ModuleSession::where('module_id',$this->id)->pluck('id')->toArray();
      $activities_id = Activity::where('hasforum',1)->whereIn('session_id',$sessions_id)->pluck('id')->toArray();
      return Forum::where('program_id',$this->program->id)->whereIn('activity_id',$activities_id);
    }


}
