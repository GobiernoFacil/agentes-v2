<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Hash;
//Modelos
use App\Models\Module;
use App\Models\Log;
use App\Models\ModuleSession;
use App\Models\Activity;
use App\Models\NewsEvent;
//Requests
use App\Http\Requests\UpdateAdminProfile;
class Fellows extends Controller
{
    //

    /**
     * Muestra panel de inicio para fellow
     *
     * @return \Illuminate\Http\Response
     */
    public function dashboard()
    {
      $user 			    = Auth::user();
      $modules        = Module::all();
      $first_module   = Module::orderBy('start','asc')->first();
      $all_modules    = Module::orderBy('start','asc')->get();
      $module_last    = null;
      $session        = null;
      $activity       = null;
      $user_log       = Log::where('user_id',$user->id)->orderBy('created_at','desc')->first();
      $newsEvent      = NewsEvent::where('public',1)->orderBy('created_at','asc')->get();
      if($user_log){
        if($user_log->session_id){
          $session = ModuleSession::find($user_log->session_id);
        }elseif($user_log->activity_id){
          $activity = Activity::find($user_log->activity_id);
        }else{
          $module_last = Module::find($user_log->module_id);;
        }
      }

      return view('fellow.dashboard')->with([
        "user"      		=> $user,
        "modules_count" => $modules->count(),
        "module"        =>  $first_module,
        "session"       => $session,
        "module_last"   => $module_last,
        "activity"      => $activity,
        "newsEvent"     => $newsEvent,
        "all_modules"   => $all_modules
      ]);
    }

    /**
     * Muestra perfil del usuario  fellow
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function viewProfile()
    {
      $user = Auth::user();
      return view('fellow.profile.profile-view')->with([
        "user"      => $user
      ]);
    }

    /**
     * edita perfil del usuario  fellow
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function editProfile()
    {
      $user = Auth::user();
      return view('fellow.profile.profile-update')->with([
        "user"      => $user
      ]);
    }

    /**
     * salva perfil del usuario fellow
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function saveProfile(UpdateAdminProfile $request)
    {
      $user = Auth::user();
      $user->name  = $request->name;
      $user->email = $request->email;

      if(!empty($request->password)){
        $user->password = Hash::make($request->password);
      }
      $user->save();

      return redirect("dashboard/perfil")->with("message",'Perfil actualizado correctamente');
    }

}
