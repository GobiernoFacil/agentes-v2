<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\ForumLog;
use App\Models\Forum;
use App\Models\ModuleSession;
class Forum extends Model
{
    //

    protected $fillable = [
      'session_id',
      'user_id',
      'state_name',
      'topic',
      'description',
      'slug',
      'type',
      'program_id',
      'session_id',
      'activity_id',
      'module_id'
    ];

    function session(){
      return $this->belongsTo("App\Models\ModuleSession");
    }

    function forum_messages(){
      return $this->hasMany("App\Models\ForumMessage");
    }

    function activity(){
      return $this->belongsTo("App\Models\Activity");
    }

    function user(){
      return $this->belongsTo("App\User");
    }

    function forum_conversations(){
      return $this->hasMany("App\Models\ForumConversation")->orderBy('created_at','desc');
    }

    function all_nonactive_forums_fellow($fellow_id){
      $today = date('Y-m-d');
      $sessions = ModuleSession::where('start','<=',$today)->pluck('id');
      $logs_id  = ForumLog::where('user_id',$fellow_id)->pluck('forum_id');
      $forums   = Forum::whereNull('state_name')->whereIn('session_id',$sessions->toArray())->whereNotIn('id',$logs_id->toArray())->orderBy('created_at','desc')->get();
      return  $forums;

    }






}
