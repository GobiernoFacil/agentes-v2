<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Hash;
use File;

use Mail;
// models
use App\User;
use App\Models\ModuleSession;
use App\Models\FacilitatorData;
use App\Models\FacilitatorModule;
use App\Models\ForumConversation;
use App\Models\Image;
use App\Models\Activity;
use App\Models\Program;


class FacilitatorActivities extends Controller
{
  //Paginación
  public $pageSize = 10;

  /**
  * Lista de actividades de usuario facilitador
  *
  * @return \Illuminate\Http\Response
  */
  public function activities()
  {
    $user 			  = Auth::user();
    $sessions     = $user->facilitator_actual_sessions()->paginate($this->pageSize);
    return view('facilitator.activities.list_activities')->with([
      "user"      		=> $user,
      "sessions"          => $sessions
    ]);
  }

  /**
    * Muestra sesión
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    public function sessions($id)
    {
      //
      $user    = Auth::user();
      $facMod  = FacilitatorModule::where('session_id',$id)->firstOrFail();
      $session = $facMod->session;
      return view('facilitator.activities.session-view')->with([
        "user"      => $user,
        "session"    => $session
      ]);
    }

   /**
    * Muestra actividad
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
   public function activities_view($id)
   {
       //
       $user     = Auth::user();
       $activity = Activity::where('id',$id)->firstOrFail();
       $session  = $activity->session;
       $activities = $session->activities()->pluck('id')->toArray();
       $pagination = $activity->get_pagination();
       if(Activity::where('id',$pagination[0])->whereIn('id',$activities)->first()){
         $prev     = $pagination[0];
       }else{
         $prev     = null;
       }
       if(Activity::where('id',$pagination[1])->whereIn('id',$activities)->first()){
         $next     = $pagination[1];
       }else{
         $next     = null;
       }
       $forum      = $activity->forum;
       if($activity->forum){
         $forums   = ForumConversation::where('forum_id',$forum->id)->orderBy('created_at','desc')->paginate($this->pageSize);
       }else{
         $forums   = null;
       }
      return view('facilitator.activities.activity-view')->with([
         "user"      	=> $user,
         "activity"   => $activity,
         "session"		=> $session,
         "prev"       => $prev,
         "next"       => $next,
         "forum"      => $forum,
         "forums"     => $forums
       ]);
   }

  /**
  * Ver actividad asignada a facilitador @ facilitador
  *
  * @return \Illuminate\Http\Response
  */
  public function viewActivity()
  {
    $user 			  = Auth::user();
    return view('facilitator.profile.profile-view')->with([
      "user"      		=> $user,
    ]);
  }



}
