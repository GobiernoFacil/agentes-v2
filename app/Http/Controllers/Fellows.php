<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Hash;
use File;
//Modelos

use App\Models\Activity;
use App\Models\Conversation;
use App\Models\ConversationLog;
use App\Models\CustomFellowAnswer;
use App\Models\CustomQuestionnaire;
use App\Models\FacilitatorModule;
use App\Models\Forum;
use App\Models\FellowData;
use App\Models\FellowFile;
use App\Models\FellowScore;
use App\Models\FellowProgram;
use App\Models\FilesEvaluation;
use App\Models\ForumConversation;
use App\Models\ForumMessage;
use App\Models\Image;
use App\Models\Log;
use App\Models\Module;
use App\Models\ModuleSession;
use App\Models\NewsEvent;
use App\Models\QuizInfo;
use App\Models\RetroLog;
use App\User;
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
      //program
      $program        = $user->actual_program();
      //modulos
      $module_last    = null;
      $session        = null;
      $activity       = null;
      //última actividad
      if($program){
        $user_log       = $user->log()->where('type','view')->where('program_id',$program->id)->orderBy('created_at','desc')->first();
      }else{
        $user_log   = null;
      }
      //noticias y eventos
      $newsEvent      = NewsEvent::where('public',1)->orderBy('created_at','desc')->limit(3)->get();
      //foros
      if(!$program){
        $forums_ids     = [];
      }else{
        $forums_ids     = $program->forums()->pluck('id')->toArray();
      }
      $forums         = ForumConversation::whereIn('forum_id',$forums_ids)->where('user_id',$user->id)->orderBy('created_at','desc')->get();
      $forums_id      = ForumConversation::whereIn('forum_id',$forums_ids)->where('user_id',$user->id)->orderBy('created_at','desc')->pluck('id');
      //conversaciones
      $messages       = ForumMessage::select('conversation_id')->where('user_id',$user->id)->whereNotIn('conversation_id',$forums_id->toArray())->groupBy('conversation_id')->get();


      $today = date("Y-m-d");
      //obtener la ultima actividad
      if($user_log){
        if($user_log->session_id){
          $session = ModuleSession::find($user_log->session_id);
        }elseif($user_log->activity_id){
          $activity = Activity::find($user_log->activity_id);
        }else{
          $module_last = Module::where('public',1)->where('id',$user_log->module_id)->first();
        }
      }
      $time = strtotime($today);
      $final = date("Y-m-d", strtotime("+1 month", $time));
      //////////   REVISAR ASAP ///////////////////////////////

      //lista de evaluaciones proximas sin contestar
      $sess_id         = ModuleSession::where('start','<=',$final)->pluck('id');
      $quiz_ids        = FellowScore::where('user_id',$user->id)->pluck('questionInfo_id');
      $activityAlready = QuizInfo::whereIn('id',$quiz_ids->toArray())->pluck('activity_id');
      $filesAlready    = FellowFile::where('user_id',$user->id)->pluck('activity_id');
      $temp = array_unique(array_merge($activityAlready->toArray(),$filesAlready->toArray()));
      $next_activities = Activity::where('type','evaluation')->where('end','>=',$today)
      ->whereIn('session_id',$sess_id->toArray())
      ->whereNotIn('id',$temp)
      ->orderBy('end','asc')
      ->limit(3)
      ->get();
      //lista de foros sin participar
      $forum  = new Forum();
      $noForum = $forum->all_nonactive_forums_fellow($user->id);
      //lista retro-alimentacion de archivos sin ver
      $retroFiles = RetroLog::where('user_id',$user->id)->orderBy('created_at','asc')->where('status',0)->get();
      //Lista de mensajes sin contestar
      $con  = new Conversation();
      $noMessages = $con->get_no_messages($user->id);

      //última actividad
      $last_activity = Log::where('user_id',$user->id)->where('type','activity')->first();

    //////////----------------------------------------------------------- ///////////////////////////////



   return view('fellow.dashboard')->with([
        "user"      		=> $user,
        "session"       => $session,
        "module_last"   => $module_last,
        "activity"      => $activity,
        "newsEvent"     => $newsEvent,
        "forums"        => $forums,
        "messagesF"     => $messages,
        "today"			    => $today,
        "next_activities" =>$next_activities,
        "noForum"       => $noForum,
        'retro'         => $retroFiles,
        'noMessages'    => $noMessages,
        "program"       => $program,
        "last_activity" => $last_activity
      ]);
    }

	/**
     * Muestra info del programa para el  fellow
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function viewInfo()
    {
      $user = Auth::user();
      //program
      $program  = $user->actual_program();
      //diagnostic as initial activity
      $module   = Module::where('program_id',$program->id)->whereNull('parent_id')->where('public',1)->first();
      if($module){
        $activity = $module->get_diagnostc_activities()->first();
      }else{
        $activity = false;
      }
      $log      = Log::firstorCreate([
        'user_id'     => $user->id,
        'type'        => 'first',
        'program_id'  => $program->id
      ]);
      return view('fellow.info_program.about_program')->with([
        "user"      => $user,
        "program"	  => $program,
        'activity'  => $activity
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
      $user    = Auth::user();
      $program = $user->actual_program();
      $activities_id = $program->get_all_fellow_activities()->pluck('id')->toArray();
      $files = FellowFile::where('user_id',$user->id)->whereIn('activity_id',$activities_id)->orderBy('created_at','desc')->paginate($this->pageSize);
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
      $program = $user->actual_program();
      $activities_id = $program->get_all_fellow_activities()->pluck('id')->toArray();
      $data = FellowFile::whereIn('activity_id',$activities_id)->where('id',$request->file_id)->where('user_id',$user->id)->firstOrFail();
      $file = $data->path;
      $fileData = pathinfo($file);
      $headers = array(
        'Content-Type: '.$fileData['extension'],
      );
      $filename = $data->name.".".$fileData['extension'];
      return response()->download($fileData['dirname'].'/'.$fileData['basename'], $filename, $headers);
    }

}
