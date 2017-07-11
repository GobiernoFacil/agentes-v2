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
use App\Models\FellowFile;
use App\Models\FellowScore;
use App\Models\Image;
use App\Models\QuizInfo;
use Carbon\Carbon;
//Requests
use App\Http\Requests\UpdateAdminProfile;
class Fellows extends Controller
{
    //
    // En esta carpeta se guardan las imágenes de los usuarios
    const UPLOADS = "img/users";
    //Paginación
    public $pageSize = 10;

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
      $newsEvent      = NewsEvent::where('public',1)->orderBy('created_at','desc')->limit(3)->get();
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
      $sess_id         = ModuleSession::where('start','<=',$final)->pluck('id');
      $quiz_ids        = FellowScore::where('user_id',$user->id)->pluck('questionInfo_id');
      $activityAlready = QuizInfo::whereIn('id',$quiz_ids->toArray())->pluck('activity_id');
      $next_activities = Activity::where('type','evaluation')->where('end','>=',$today)
      ->whereIn('session_id',$sess_id->toArray())
      ->whereNotIn('id',$activityAlready->toArray())
      ->orderBy('end','asc')
      ->limit(3)
      ->get();

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

    /**
     * ver archivos de evaluación del usuario  fellow
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function viewFiles()
    {
      $user = Auth::user();
      $files = FellowFile::where('user_id',$user->id)->orderBy('created_at','desc')->paginate($this->pageSize);
      return view('fellow.profile.profile-files')->with([
        "user"      => $user,
        "files"     => $files
      ]);
    }

    /**
    *
    *
    * @return \Illuminate\Http\Response
    */
    public function download(Request $request){
      $user = Auth::user();
      $data = FellowFile::where('id',$request->file_id)->where('user_id',$user->id)->firstOrFail();
      $file = $data->path;
      $ext  = substr(strrchr($file,'.'),1);
      $mime = mime_content_type ($file);
      $headers = array(
        'Content-Type: '.$mime,
      );

      $filename = $data->name.".".$ext;
      return response()->download($file, $filename, $headers);
    }

}
