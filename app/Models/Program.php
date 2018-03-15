<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Activity;
use App\Models\Aspirant;
use App\Models\Forum;
use App\Models\ModuleSession;

use App\User;

class Program extends Model
{
    //
    protected $fillable = [
      'notice_id',
      'title',
      'description',
      'slug',
      'start',
      'end',
      'public'
    ];


    function modules(){
      return $this->hasMany("App\Models\Module")->orderBy('order','asc');
    }

    function notice(){
      return $this->hasOne("App\Models\NoticeProgram");
    }

    function fellows(){
      return $this->hasMany("App\Models\FellowProgram");
    }

    function get_all_fellows(){
      $fellows = $this->fellows->pluck('user_id')->toArray();
      return User::where('enabled',1)->where('type','fellow')->whereIn('id',$fellows);

    }

    function get_all_activities(){
      $modules  = $this->modules->pluck('id')->toArray();
      $sessions = ModuleSession::whereIn('module_id',$modules)->pluck('id')->toArray();
      return  Activity::whereIn('session_id',$sessions);

    }
    function get_all_eva_activities(){
      $modules  = $this->modules->pluck('id')->toArray();
      $sessions = ModuleSession::whereIn('module_id',$modules)->pluck('id')->toArray();
      return  Activity::where('type','evaluation')->whereIn('session_id',$sessions);

    }

    function forums(){
      return $this->hasMany('App\Models\Forum','program_id');
    }

    function get_all_sessions(){
      $modules = $this->modules()->pluck('id')->toArray();
      return ModuleSession::whereIn('module_id',$modules);
    }

    function get_available_types(){
      //tipos para foros
      $type   = [];
      $states    = $this->get_available_states();
      if($states){
        $types['state'] = 'Estado';
      }
      if(!Forum::where('program_id',$this->id)->where('type','general')->first()){
        $types['general'] = 'General';
      }
      if(!Forum::where('program_id',$this->id)->where('type','support')->first()){
        $types['support'] = 'Soporte Técnico';
      }

      $types['activity'] = 'Sesión';
      $types['0'] = 'Selecciona una opción';

      return $types;
    }

    function get_available_states(){
      //estados para foros
      $notice  = $this->notice->notice_data;
      $aspirants_id = $notice->aspirants()->pluck('aspirant_id');
      $state_names_already = Forum::where('program_id',$this->id)->pluck('state_name')->toArray();
      $states = Aspirant::select('state')->whereNotIn('state',$state_names_already)->whereIn('id',$aspirants_id->toArray())->distinct()->orderBy('state','asc')->pluck('state','state')->toArray();
      if(!$states){
        return false;
      }
      $states['0'] = 'Selecciona una opción';
      return $states;
    }
}
