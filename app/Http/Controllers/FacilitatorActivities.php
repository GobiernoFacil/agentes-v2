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
       $user    = Auth::user();
       $activity = Activity::find($id);
       $session = ModuleSession::where('id',$activity->session_id)->firstOrFail();
       $pagination = $activity->get_pagination();
       $prev     = $pagination[0];
       $next     = $pagination[1];
      return view('facilitator.activities.activity-view')->with([
         "user"      	=> $user,
         "activity"   => $activity,
         "session"		=> $session,
         "prev"       => $prev,
         "next"       => $next
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
