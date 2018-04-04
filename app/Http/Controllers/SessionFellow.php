<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
// models
use App\Models\Module;
use App\Models\ModuleSession;
use App\Models\Activity;
use App\Models\FellowFile;
use App\Models\FellowScore;
use App\Models\ForumConversation;

use App\Models\Log;
use App\Models\DiagnosticAnswer;
use App\User;

// FormValidators
use App\Http\Requests\SaveDiagnostic;
class SessionFellow extends Controller
{
	//Paginación
  public $pageSize = 10;
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
      $log->program_id = $session->module->program->id;
      $log->save();
      return view('fellow.modules.sessions.session-view')->with([
        "user"      => $user,
        "session"    => $session,
        "today" =>$today
      ]);
    }

    public function activity($program_slug,$module_slug,$session_slug,$activity_slug)
    {
      //
      $user      = Auth::user();
      $session   = ModuleSession::where('slug',$session_slug)->first();
      $activity  = Activity::where('slug',$activity_slug)->first();
      $files     = FellowFile::where('user_id',$user->id)->where('activity_id',$activity->id)->count();
      $forum    = $activity->forum;
      //forums
      if($activity->forum){
        $forums   = ForumConversation::where('forum_id',$forum->id)->orderBy('created_at','desc')->paginate($this->pageSize);
      }else{
        $forums   = null;
      }
      if($activity->quizInfo){
        $score     = FellowScore::where('questionInfo_id',$activity->quizInfo->id)->where('user_id',$user->id)->first();
      }else{
        $score = null;
      }
      $log     = Log::firstOrCreate(['user_id'=>$user->id,'type'=>'view']);
      $log->session_id = null;
      $log->module_id = null;
      $log->activity_id = $activity->id;
      $log->program_id = $session->module->program->id;
      $log->save();
      $log     = Log::firstOrCreate(['user_id'=>$user->id,'type'=>'activity']);
      $log->session_id = null;
      $log->module_id = null;
      $log->activity_id = $activity->id;
      $log->program_id = $session->module->program->id;
      $log->save();
      return view('fellow.modules.sessions.activity-view')->with([
        "user"      => $user,
        "session"   => $session,
        "activity"  => $activity,
        'files'     => $files,
        "score"     => $score,
        "forums"	=> $forums,
        "forum"		=> $forum,
      ]);
    }

    /**
    * Muestra sessión
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    public function viewFacilitator($module_slug,$slug,$id)
    {
      //
      $user    = Auth::user();
      $session  = ModuleSession::where('slug',$slug)->firstOrFail();
      $facilitator = User::where('id',$id)->firstOrFail();
      $today = date("Y-m-d");
      return view('fellow.modules.sessions.facilitator-view')->with([
        "user"      => $user,
        "session"    => $session,
        "today" =>$today,
        "facilitator" => $facilitator
      ]);
    }

    public function diagnostic()
    {
      //
      $user      = Auth::user();
      $activity  = Activity::where('slug','examen-diagnostico')->first();
      $answer    = DiagnosticAnswer::where('user_id',$user->id)->first();
      if($answer){
        return redirect("tablero/aprendizaje/examen-diagnostico/examen-diagnostico/$activity->id")->with('error','Ya has contestado la evaluación');
      }
      $log     = Log::firstOrCreate(['user_id'=>$user->id,'type'=>'view']);
      $log->session_id = null;
      $log->module_id = null;
      $log->activity_id = $activity->id;
      $log->program_id = $session->module->program->id;
      $log->save();
      return view('fellow.diagnostic.add-diagnostic')->with([
        "user"      => $user,
        "activity"  => $activity
      ]);
    }

    public function saveDiagnostic(SaveDiagnostic $request)
    {
      //
      $user      = Auth::user();
      $answers   = new DiagnosticAnswer($request->except('_token'));
      $activity  = Activity::where('slug','examen-diagnostico')->first();
      $answers->user_id  = $user->id;
      $answers->save();
      return redirect("tablero/aprendizaje/examen-diagnostico/examen-diagnostico/$activity->id")->with('success','Se ha guardado correctamente');
    }

}
