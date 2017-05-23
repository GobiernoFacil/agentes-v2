<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
// models
use App\Models\Module;
use App\Models\ModuleSession;
use App\Models\Activity;
use App\Models\Log;

class SessionFellow extends Controller
{
    //

    /**
    * Muestra sessión
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    public function view($module_slug,$slug)
    {
      //
      $user    = Auth::user();
      $session  = ModuleSession::where('slug',$slug)->firstOrFail();
      $today = date("Y-m-d");
      $log     = Log::firstOrCreate(['user_id'=>$user->id,'type'=>'view']);
      $log->session_id = $session->id;
      $log->module_id = null;
      $log->activity_id = null;
      $log->save();
      return view('fellow.modules.sessions.session-view')->with([
        "user"      => $user,
        "session"    => $session,
        "today" =>$today
      ]);
    }

    public function activity($module_slug,$slug,$id)
    {
      //
      $user      = Auth::user();
      $session   = ModuleSession::where('slug',$slug)->first();
      $activity  = Activity::where('id',$id)->first();
      $log     = Log::firstOrCreate(['user_id'=>$user->id,'type'=>'view']);
      $log->session_id = null;
      $log->module_id = null;
      $log->activity_id = $activity->id;
      $log->save();
      return view('fellow.modules.sessions.activity-view')->with([
        "user"      => $user,
        "session"   => $session,
        "activity"  => $activity
      ]);
    }

}
