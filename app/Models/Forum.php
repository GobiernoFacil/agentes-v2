<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use App\Notifications\SendForumNotice;
use App\Models\FacilitatorModule;
use App\Models\FellowData;
use App\Models\ForumLog;
use App\Models\Forum;
use App\Models\ModuleSession;
use App\User;
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
      'activity_id',
      'module_id'
    ];

    function session(){
      return $this->belongsTo("App\Models\ModuleSession");
    }
    function program(){
      return $this->belongsTo("App\Models\Program");
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

    function forum_log(){
      return $this->hasMany("App\Models\ForumLog");
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

    function check_participation($fellow_id){
      if(ForumLog::where('forum_id',$this->id)->where('user_id',$fellow_id)->where('type','fellow')->first()){
        return true;
      }else{
        return false;
      }

    }


    function send_notification_to($program,$conversation,$type,$message=null){
              $fellows               =   $program->fellows()->pluck('user_id')->toArray();
              $prosociedad_gen_mails = ['carlos.bauche@prosociedad.org'];
              $prosociedad_act_mails = ['german@prosociedad.org'];
              if($this->type ==='activity'){
                  //usuarios en el foro
                 $user_ids = ForumLog::where('forum_id',$this->id)->whereIn('user_id',$fellows)->pluck('user_id')->toArray();
                 $users    = User::whereIn('id',$user_ids)->where('type','fellow')
                 ->orWhere(function($query)use($prosociedad_act_mails){
                   $query->where('institution','PROSOCIEDAD')->whereIn('email',$prosociedad_act_mails);
                 })
                 ->where('enabled',1)
                 ->get();
                 foreach ($users as $userA) {
                      $this->send($program,$userA,$this,$conversation,$type,$message);
                 }

              }elseif($this->type ==='general'){
                  //a todos los usuarios fellow y facilitator PROSOCIEDAD
                  $modules_id = $program->fellow_modules()->pluck('id')->toArray();
                  if($type==='message'){
                    $assign_f = FacilitatorModule::whereIn('module_id',$modules_id)->pluck('user_id')->toArray();
                    $user_ids = ForumLog::where('conversation_id',$message->conversation->id)->whereIn('user_id',$fellows)->pluck('user_id')->toArray();
                    $users    = User::where('type','fellow')->whereIn('id',$user_ids)
                    ->orWhere(function($query)use($prosociedad_gen_mails){
                      $query->where('institution','PROSOCIEDAD')->whereIn('email',$prosociedad_gen_mails);
                    })
                    ->where('enabled',1)->get();

                  }else{
                    $assign_f = FacilitatorModule::whereIn('module_id',$modules_id)->pluck('user_id')->toArray();
                    $users = User::where('type','fellow')->whereIn('id',$fellows)
                    ->orWhere(function($query)use($prosociedad_gen_mails){
                      $query->where('institution','PROSOCIEDAD')->whereIn('email',$prosociedad_gen_mails);
                    })
                    ->where('enabled',1)->get();
                  }
                   foreach ($users as $userA) {
                     $this->send($program,$userA,$this,$conversation,$type,$message);
                   }
              }elseif($this->type ==='state'){
                //usuarios del estado
                if($type==='message'){
                  $assign_state = FellowData::whereIn('user_id',$fellows)->where('state',$this->state_name)->pluck('user_id');
                  $user_ids     = ForumLog::where('conversation_id',$message->conversation->id)->whereIn('user_id',$assign_state)->pluck('user_id')->toArray();
                  $users        = User::where('type','fellow')->whereIn('id',$user_ids)
                  ->orWhere(function($query)use($prosociedad_gen_mails){
                    $query->whereIn('email',$prosociedad_gen_mails)->where('institution','PROSOCIEDAD');
                  })
                  ->where('enabled',1)->get();

                }else{
                  $assign_state = FellowData::whereIn('user_id',$fellows)->where('state',$this->state_name)->pluck('user_id');
                  $users     = User::where('type','fellow')->whereIn('id',$assign_state)
                  ->orWhere(function($query)use($prosociedad_gen_mails){
                    $query->whereIn('email',$prosociedad_gen_mails)->where('institution','PROSOCIEDAD');
                  })
                  ->where('enabled',1)->get();
                }
                 foreach ($users as $userA) {
                   $this->send($program,$userA,$this,$conversation,$type,$message);
                 }

              }elseif($this->type ==='support'){
                //usuario gf y participantes
                $support = 'howdy@gobiernofacil.com';
                if($type==='message'){
                  $user_ids = ForumLog::where('conversation_id',$message->conversation->id)->whereIn('user_id',$fellows)->pluck('user_id')->toArray();
                  $users    = User::whereIn('id',$user_ids)->where('type','fellow')
                  ->orWhere(function($query)use($support){
                    $query->where('type','admin')->where('email',$support)->where('enabled',1);
                  })
                  ->where('enabled',1)
                  ->get();
                }else{
                  $users = User::where('type','admin')->where('email',$support)->where('enabled',1)->get();
                }
                foreach ($users as $userA) {
                   $this->send($program,$userA,$this,$conversation,$type,$message);
                }

                }

              return true;

          }



    protected function send($program,$userA,$forum,$conversation,$type,$message){
            if($type==='create'){
              $userA->notify(new SendForumNotice($program,$userA,$forum,$type,null,null));
            }else{
              $userA->notify(new SendForumNotice($program,$userA,$forum,$type,$conversation,$message));
            }

            return true;
          }






}
