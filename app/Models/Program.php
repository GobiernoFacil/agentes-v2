<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Activity;
use App\Models\Aspirant;
use App\Models\Conversation;
use App\Models\Forum;
use App\Models\Module;
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

    function fellow_modules(){
      return $this->hasMany("App\Models\Module")->where('public',1)->orderBy('order','asc');
    }

    function surveys(){
      return $this->hasMany("App\Models\CustomQuestionnaire")->where('type','general')->orderBy('created_at','desc');
    }

    function get_modules_with_forums(){
      $modules = $this->fellow_modules->pluck('id')->toArray();
      $module_ids = Forum::whereIn('module_id',$modules)->pluck('module_id')->toArray();
      return   Module::whereIn('id',$module_ids)->where('public',1)->where('program_id',$this->id)->orderBy('order','asc');

    }

    function get_admin_modules_with_forums(){
      $modules = $this->modules->pluck('id')->toArray();
      $module_ids = Forum::whereIn('module_id',$modules)->pluck('module_id')->toArray();
      return   Module::whereIn('id',$module_ids)->where('public',1)->where('program_id',$this->id)->orderBy('order','asc');

    }

    function get_fellow_modules_with_ev_act(){
      $sessions_id = Activity::where('type','evaluation')
      ->orWhere(function($query){
        $query->where('type','diagnostic');
      })
      ->orWhere(function($query){
        $query->where('type','final');
      })->pluck('session_id')->toArray();
      $modules_id = ModuleSession::whereIn('id',$sessions_id)->pluck('module_id')->toArray();
      return  Module::whereIn('id',$modules_id)->where('public',1)->where('program_id',$this->id)->orderBy('order','asc');
    }

    function notice(){
      return $this->hasOne("App\Models\NoticeProgram");
    }

    function messages($user_id){
      return Conversation::where('program_id',$this->id)->where('user_id',$user_id)
      ->orWhere(function($query)use($user_id){
        $query->where('program_id',$this->id)->where('to_id',$user_id);
      });
    }

    function fellows(){
      return $this->hasMany("App\Models\FellowProgram")->where('user_id','!=',23);
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

    function get_all_fellow_activities(){
      $modules  = $this->fellow_modules->pluck('id')->toArray();
      $sessions = ModuleSession::whereIn('module_id',$modules)->pluck('id')->toArray();
      return  Activity::whereIn('session_id',$sessions);
    }

    function get_all_eva_activities(){
      $modules  = $this->modules->pluck('id')->toArray();
      $sessions = ModuleSession::whereIn('module_id',$modules)->pluck('id')->toArray();
      return  Activity::where('type','evaluation')->whereIn('session_id',$sessions)->orWhere(function($query)use($sessions){
        $query->where('type','diagnostic')
        ->whereIn('session_id',$sessions);
      });

    }

    function get_all_fellow_eva_activities(){
      $modules  = $this->fellow_modules->pluck('id')->toArray();
      $sessions = ModuleSession::whereIn('module_id',$modules)->pluck('id')->toArray();
      return  Activity::where('type','evaluation')->whereIn('session_id',$sessions);

    }

    function forums(){
      return $this->hasMany('App\Models\Forum','program_id');
    }

    function fellow_forums($user){

      $today = date("Y-m-d");
      $sessions_id   = $this->get_all_fellow_sessions()->pluck('id')->toArray();
      $activities_id = Activity::where('end','<=',$today)->where('hasforum',1)->whereIn('session_id',$sessions_id)->pluck('id')->toArray();
      $forums = $this->forums()->pluck('id')->toArray();
      return Forum::where('state_name',$user->fellowData->state)->where('program_id',$this->id)
      ->orWhere(function($query)use($activities_id){
        $query->whereIn('activity_id',$activities_id);
      })
      ->orWhere(function($query){
        $query->whereIn('type',['general','support']);
      })->whereIn('id',$forums);
    }

    function fellow_act_forums(){
      $today = date("Y-m-d");
      $modules_id    = Module::where('program_id',$this->id)->where('start','<=',$today)->pluck('id')->toArray();
      $sessions_id   = ModuleSession::whereIn('module_id',$modules_id)->pluck('id')->toArray();
      $activities_id = Activity::where('hasforum',1)->whereIn('session_id',$sessions_id)->pluck('id')->toArray();
      return Forum::where('program_id',$this->id)->whereIn('activity_id',$activities_id)
      ->orWhere(function($query){
        $query->where('program_id',$this->id)->whereIn('type',['general']);
      });
    }

    function actual_week_forums(){
      $today = date("Y-m-d");
      $modules_id    = Module::where('program_id',$this->id)->where('start','<=',$today)->where('end','>=',$today)->pluck('id')->toArray();
      $sessions_id   = ModuleSession::whereIn('module_id',$modules_id)->pluck('id')->toArray();
      $activities_id   = Activity::where('end','>=',$today)->where('hasforum',1)->whereIn('session_id',$sessions_id)->pluck('id')->toArray();
      return Forum::whereIn('activity_id',$activities_id)->where('program_id',$this->id)->where('type','activity');

    }

    function get_all_sessions(){
      $modules = $this->modules()->pluck('id')->toArray();
      return ModuleSession::whereIn('module_id',$modules)->orderBy('order','asc');
    }

    function get_all_fellow_sessions(){
      $modules = $this->fellow_modules()->pluck('id')->toArray();
      return ModuleSession::whereIn('module_id',$modules)->orderBy('order','asc');
    }



    function get_available_types(){
      //tipos para foros
      $type   = [];
      $types['activity'] = 'Actividad';
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


      $types[null] = 'Selecciona una opción';

      return $types;
    }

    function get_available_states(){
      //estados para foros
      $notice  = $this->notice->notice_data;
      $aspirants_id = $notice->aspirants()->pluck('aspirant_id');
      $state_names_already = Forum::where('program_id',$this->id)->pluck('state_name')->toArray();
      $states = Aspirant::select('state')->whereIn('id',$aspirants_id->toArray())->distinct()->orderBy('state','asc')->pluck('state','state')->toArray();
      $states = array_diff($states,$state_names_already);
      if(!$states){
        return [];
      }
      $states[null] = 'Selecciona una opción';
      return $states;
    }

    function final_evaluation(){
      $modules  = $this->modules->pluck('id')->toArray();
      $sessions = ModuleSession::whereIn('module_id',$modules)->pluck('id')->toArray();
      return  Activity::where('type','final')->whereIn('session_id',$sessions);
    }

    function final_fellow_evaluation(){
      $modules  = $this->fellow_modules->pluck('id')->toArray();
      $sessions = ModuleSession::whereIn('module_id',$modules)->pluck('id')->toArray();
      return  Activity::where('type','final')->whereIn('session_id',$sessions)->first();
    }

    function get_active_modules(){
      $today = date('Y-m-d');
      $ids   = $this->fellow_modules->pluck('id')->toArray();
      return Module::whereIn('id',$ids)->where('start','<=',$today)->orderBy('start','asc');
    }

    function get_active_modules_with_forums(){
      $modules          = $this->get_active_modules()->pluck('id')->toArray();
      $sessions         = ModuleSession::whereIn('module_id',$modules)->pluck('id')->toArray();
      $sess_with_forums = Activity::whereIn('session_id',$sessions)->where('hasforum',1)->pluck('session_id')->toArray();
      $modules_ids      = ModuleSession::whereIn('id',$sess_with_forums)->pluck('module_id')->toArray();
      return Module::whereIn('id',$modules_ids)->orderBy('start','desc');

    }



    function get_assigned_sessions($user_id){
      $sessions    = $this->get_all_sessions()->pluck('id')->toArray();
      return FacilitatorModule::whereIn('session_id',$sessions)->where('user_id',$user_id);

    }
}
