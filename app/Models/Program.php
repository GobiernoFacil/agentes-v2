<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Activity;
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
}
