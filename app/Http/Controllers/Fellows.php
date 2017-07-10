<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Hash;
use File;
//Modelos
use App\Models\Module;
use App\Models\Log;
use App\Models\ModuleSession;
use App\Models\Activity;
use App\Models\NewsEvent;
use App\Models\Forum;
use App\Models\ForumConversation;
use App\Models\ForumMessage;
use App\Models\FellowData;
use App\Models\Image;
use Carbon\Carbon;
//Requests
use App\Http\Requests\UpdateAdminProfile;
class Fellows extends Controller
{
    //
    // En esta carpeta se guardan las imágenes de los usuarios
    const UPLOADS = "img/users";

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
      $forums         = ForumConversation::where('user_id',$user->id)->orderBy('created_at','desc')->get();
      $forums_id      = ForumConversation::where('user_id',$user->id)->orderBy('created_at','desc')->pluck('id');
      $messages       = ForumMessage::select('conversation_id')->where('user_id',$user->id)->whereNotIn('conversation_id',$forums_id->toArray())->groupBy('conversation_id')->get();
      $today = date("Y-m-d");
      if($user_log){
        if($user_log->session_id){
          $session = ModuleSession::find($user_log->session_id);
        }elseif($user_log->activity_id){
          $activity = Activity::find($user_log->activity_id);
        }else{
          $module_last = Module::find($user_log->module_id);;
        }
      }
      $time = strtotime($today);
      $final = date("Y-m-d", strtotime("+1 month", $time));
      $sess_id         = ModuleSession::where('start','<=',$final)->where('start','>=',$today)->pluck('id');
      $next_activities = Activity::where('type','evaluation')->whereIn('session_id',$sess_id->toArray())->orderBy('session_id','asc')->limit(3)->get();

   return view('fellow.dashboard')->with([
        "user"      		=> $user,
        "modules_count" => $modules->count(),
        "module"        =>  $first_module,
        "session"       => $session,
        "module_last"   => $module_last,
        "activity"      => $activity,
        "newsEvent"     => $newsEvent,
        "all_modules"   => $all_modules,
        "forums"        => $forums,
        "messagesF"     => $messages,
        "today"			    => $today,
        "next_activities" =>$next_activities
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
      //update user data
      if(!empty($request->password)){
        $data   = $request->only(['name','email','password']);
        $data['password'] = Hash::make($request->password);
      }else {
        $data   = $request->only(['name','email']);
      }

      $user->update($data);
      //update fellow data
      FellowData::where('user_id',$user->id)->update($request->except(['_token','name','email','image','password','password-confirm']));

      // [ SAVE THE IMAGE ]
      if($request->hasFile('image') && $request->file('image')->isValid()){
        $path  = public_path(self::UPLOADS);
        $name = uniqid() . '.' . $request->file('image')->getClientOriginalExtension();
        $request->file('image')->move($path, $name);
        if($user->image){
          File::delete($user->image->path."/".$user->image->name);
        }
        $image   = Image::firstorCreate(['user_id'=>$user->id,]);
        $image->name = $name;
        $image->path = $path;
        $image->type = 'full';
        $image->save();
      }

      return redirect("tablero/perfil")->with("message",'Perfil actualizado correctamente');
    }

}
