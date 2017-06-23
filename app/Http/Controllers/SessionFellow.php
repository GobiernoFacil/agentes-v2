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
use App\Models\Log;
use App\Models\DiagnosticAnswer;
use App\User;

// FormValidators
use App\Http\Requests\SaveDiagnostic;
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
      $files     = FellowFile::where('user_id',$user->id)->where('activity_id',$activity->id)->count();
      if($activity->quizInfo){
        $score     = FellowScore::where('questionInfo_id',$activity->quizInfo->id)->count();
      }else{
        $score = null;
      }
      $log     = Log::firstOrCreate(['user_id'=>$user->id,'type'=>'view']);
      $log->session_id = null;
      $log->module_id = null;
      $log->activity_id = $activity->id;
      $log->save();
      return view('fellow.modules.sessions.activity-view')->with([
        "user"      => $user,
        "session"   => $session,
        "activity"  => $activity,
        'files'     => $files,
        "score"     => $score
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
