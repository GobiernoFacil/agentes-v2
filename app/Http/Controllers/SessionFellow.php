<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
// models
use App\Models\Module;
use App\Models\ModuleSession;
use App\Models\Activity;
use App\Models\CustomFellowAnswer;
use App\Models\FellowAnswer;
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
    public function view($program_slug,$module_slug,$slug)
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
      $session   = ModuleSession::where('slug',$session_slug)->firstOrFail();
      $activity  = Activity::where('slug',$activity_slug)->firstOrFail();
      $files     = FellowFile::where('user_id',$user->id)->where('activity_id',$activity->id)->count();
      $pagination = $activity->get_pagination();
      if($prev_ac = Activity::where('id',$pagination[0])->first()){
        $prev = $prev_ac->slug;
      }else{
        $prev = false;
      }
      if($next_ac = Activity::where('id',$pagination[1])->first()){
        $next = $next_ac->slug;
      }else{
        $next = false;
      }
      $forum    = $activity->forum;
      //forums
      if($activity->forum){
        $forums   = ForumConversation::where('forum_id',$forum->id)->orderBy('created_at','desc')->paginate($this->pageSize);
      }else{
        $forums   = null;
      }

      if($activity->type==='evaluation'){
        if($score  = FellowScore::where('questionInfo_id',$activity->quizInfo->id)->where('user_id',$user->id)->first()){
            $fellow_questions = null;
        }else{
            $answersAlr = FellowAnswer::where('user_id',$user->id)->where('questionInfo_id',$activity->quizInfo->id)->pluck('question_id')->toArray();
            $fellow_questions = $activity->quizInfo->question()->select('question','id')->whereNotIn('id',$answersAlr)->get();
        }
      }elseif($activity->type==='diagnostic'){
          $score            = null;
          $answersAlr = CustomFellowAnswer::where('user_id',$user->id)->where('questionnaire_id',$activity->diagnosticInfo->id)->pluck('question_id')->toArray();
          $fellow_questions = $activity->diagnosticInfo->questions()->select('question','id','type', 'required')->whereNotIn('id',$answersAlr)->get();

      }else{
        $score            = null;
        $fellow_questions = null;
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
        "user"              => $user,
        "session"           => $session,
        "activity"          => $activity,
        'files'             => $files,
        "score"             => $score,
        "forums"	          => $forums,
        "forum"		          => $forum,
        "prev"              => $prev,
        "next"              => $next,
        "fellow_questions"  =>$fellow_questions
       ]);
    }

    /**
    * Muestra sessión
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    public function viewFacilitator($program_slug,$module_slug,$slug,$id)
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

    public function old_diagnostic()
    {
      //
      $user      = Auth::user();
      $activity  = Activity::where('slug','examen-diagnostico')->first();
      $answer    = DiagnosticAnswer::where('user_id',$user->id)->first();
      if($answer){
        return redirect("tablero/aprendizaje/examen-diagnostico/examen-diagnostico/$activity->id")->with('error','Ya has contestado la evaluación');
      }
      $log     = Log::firstOrCreate(['user_id'=>$user->id,'type'=>'activity']);
      $log->session_id  = $activity->session->id;
      $log->module_id   = $activity->session->module->id;
      $log->activity_id = $activity->id;
      $log->program_id  = $activity->session->module->program->id;
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

    /**
    * Muestra fin de módulo
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    public function end($program_slug,$module_slug,$session_slug)
    {
      //
      $user       = Auth::user();
      $session    = ModuleSession::where('slug',$session_slug)->firstOrFail();
      $last       = Activity::where('session_id',$session->id)->orderBy('order','desc')->firstOrFail();
      $prev       = $last->slug;
      $next       = false;
      $complete   = $user->update_module_progress($session->module->slug);
      return view('fellow.modules.sessions.session-end')->with([
        "user"      => $user,
        "session"   => $session,
        "prev"      => $prev,
        "next"      => $next,
        "complete"  => $complete
       ]);
    }


}
