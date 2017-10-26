<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Hash;
use File;
//Modelos
use App\User;
use App\Models\Module;
use App\Models\Conversation;
use App\Models\Log;
use App\Models\ModuleSession;
use App\Models\Activity;
use App\Models\NewsEvent;
use App\Models\FacilitatorModule;
use App\Models\Forum;
use App\Models\ForumConversation;
use App\Models\ForumMessage;
use App\Models\FellowData;
use App\Models\FellowFile;
use App\Models\FellowScore;
use App\Models\FilesEvaluation;
use App\Models\Image;
use App\Models\RetroLog;
use App\Models\ConversationLog;
use App\Models\QuizInfo;
use App\Models\CustomFellowAnswer;
use App\Models\CustomQuestionnaire;
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
      //modulos
      $modules        = Module::all();
      $first_module   = Module::orderBy('start','asc')->first();
      $all_modules    = Module::orderBy('start','asc')->get();
      $module_last    = null;
      $session        = null;
      $activity       = null;
      //última actividad
      $user_log       = Log::where('user_id',$user->id)->orderBy('created_at','desc')->first();
      //noticias y eventos
      $newsEvent      = NewsEvent::where('public',1)->orderBy('created_at','desc')->limit(3)->get();
      //foros
      $forums         = ForumConversation::where('user_id',$user->id)->orderBy('created_at','desc')->get();
      $forums_id      = ForumConversation::where('user_id',$user->id)->orderBy('created_at','desc')->pluck('id');
      //conversaciones
      $messages       = ForumMessage::select('conversation_id')->where('user_id',$user->id)->whereNotIn('conversation_id',$forums_id->toArray())->groupBy('conversation_id')->get();
      //encuestas
      $module_survey  = Module::where('title','CURSO 1 - Gobierno Abierto y los ODS')->first();
      $non_email_list = ['contacto@prosociedad.org'];
      $non_user_sur   = User::whereIn('email',$non_email_list)->pluck('id');
      $fac_number    = FacilitatorModule::where('module_id',$module_survey->id)->whereNotIn('user_id',$non_user_sur->toArray())->count();

      $module_survey_2  = Module::where('title','CURSO 2 - Herramientas para la Acción')->first();
      $user_sur         = FacilitatorModule::where('module_id',$module_survey_2->id)->pluck('user_id');
      $q_fac            = CustomQuestionnaire::where('type','facilitator')->first();
      $custom_number_q  = CustomFellowAnswer::where('questionnaire_id',$q_fac->id)->where('user_id',$user->id)->whereIn('facilitator_id',$user_sur->toArray())->distinct('facilitator_id')->count('facilitator_id');

      $module_survey_3  = Module::where('title','CURSO 3 - Aterrizaje: "Ya tengo mi agenda, y ahora qué..."')->first();
      $user_sur_3       = FacilitatorModule::where('module_id',$module_survey_3->id)->pluck('user_id');
      $custom_number_q_3  = CustomFellowAnswer::where('questionnaire_id',$q_fac->id)->where('user_id',$user->id)->whereIn('facilitator_id',$user_sur->toArray())->distinct('facilitator_id')->count('facilitator_id');

      $today = date("Y-m-d");
      //obtener la ultima actividad
      if($user_log){
        if($user_log->session_id){
          $session = ModuleSession::find($user_log->session_id);
        }elseif($user_log->activity_id){
          $activity = Activity::find($user_log->activity_id);
        }else{
          $module_last = Module::find($user_log->module_id);
        }
      }
      $time = strtotime($today);
      $final = date("Y-m-d", strtotime("+1 month", $time));
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
      //diagnostico
      $questionnaire   = CustomQuestionnaire::where('slug','transversalizacion-de-la-perspectiva-de-genero')->first();
      $answers         = CustomFellowAnswer::where('user_id',$user->id)->where('questionnaire_id',$questionnaire->id)->first();
      //diagnostico seminario 2
      $questionnaire_2      = CustomQuestionnaire::where('slug','evaluacion-de-seminario-2')->first();
      $diagnostic_2         = CustomFellowAnswer::where('user_id',$user->id)->where('questionnaire_id',$questionnaire_2->id)->first();

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
        "next_activities" =>$next_activities,
        "noForum"       => $noForum,
        'retro'         => $retroFiles,
        'noMessages'    => $noMessages,
        'fac_number'    => $fac_number,
        'custom_test'   => $answers,
        'questionnaire' => $questionnaire,
        'diagnostic_2'  => $diagnostic_2,
        'questionnaire_2' => $questionnaire_2,
        "user_sur"      => $user_sur,
        "custom_number_q" => $custom_number_q,
        "user_sur_3"      => $user_sur_3,
        "custom_number_q_3" => $custom_number_q_3
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
