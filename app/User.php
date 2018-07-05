<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Cache;
use App\Notifications\MyResetPassword;
use App\Models\FellowAnswer;
use App\Models\Activity;
use App\Models\Aspirant;
use App\Models\Conversation;
use App\Models\CustomFellowAnswer;
use App\Models\ConversationLog;
use App\Models\StoreConversation;
use App\Models\FilesEvaluation;
use App\Models\FellowScore;
use App\Models\FellowFile;
use App\Models\FacilitatorModule;
use App\Models\FellowProgram;
use App\Models\FacilitatorSurvey;
use App\Models\Forum;
use App\Models\ForumLog;
use App\Models\FellowAverage;
use App\Models\FellowProgress;
use App\Models\Message;
use App\Models\Module;
use App\Models\ModuleSession;
use App\Models\Program;
use App\Models\QuizInfo;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','type','enabled','institution'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function sendPasswordResetNotification($token)
    {
        $this->notify(new MyResetPassword($token));
    }

    function modules(){
      return $this->hasMany("App\Models\FacilitatorModule")->orderBy('order','asc');
    }

    function facilitatorSessions(){
      return $this->hasMany("App\Models\FacilitatorModule");
    }
    function conversation(){
      return $this->hasMany("App\Models\Conversation");
    }
    function facilitatorData(){
      return $this->hasOne("App\Models\FacilitatorData");
    }

    function aspirant($user){
      return Aspirant::where('email',$this->email)->first();
    }

    function image(){
      return $this->hasOne("App\Models\Image");
    }

    function fellowData(){
      return $this->hasOne("App\Models\FellowData");
    }

    function log(){
      return $this->hasMany("App\Models\Log");
    }

    function conversations(){
      return $this->hasMany("App\Models\Conversation");
    }


    function diagnostic(){
      return $this->hasOne("App\Models\DiagnosticAnswer");
    }

    function new_diagnostic($quiz_id){
      return CustomFellowAnswer::where('user_id',$this->id)->where('questionnaire_id',$quiz_id);
    }

    function diagnosticEvaluation(){
      return $this->hasOne("App\Models\DiagnosticEvaluation");
    }

    function fellowFiles(){
      return $this->hasMany("App\Models\FellowFile");
    }

    function fellowAnswers(){
      return $this->hasMany("App\Models\FellowAnswer");
    }

    function fellowScore(){
      return $this->hasMany("App\Models\FellowScore");
    }

    function fileScore(){
      return $this->hasMany("App\Models\FilesEvaluation",'fellow_id');
    }

    function fellowAnswer($question_id,$user_id){
      $answer = FellowAnswer::where('question_id',$question_id)->where('user_id',$user_id)->first();
      return $answer ;
    }

    function fellowMAnswer($question_id,$user_id,$answer_id){
      $answer = FellowAnswer::where('question_id',$question_id)->where('user_id',$user_id)->where('answer_id',$answer_id)->first();
      return $answer ;
    }


    function fellowMultipleAnswers($question_id,$user_id){
      $answer = FellowAnswer::where('question_id',$question_id)->where('user_id',$user_id)->get();
      return $answer ;
    }

    function count_incorrect($question_id,$user_id){
      $answer = FellowAnswer::where('question_id',$question_id)->where('user_id',$user_id)->where('correct',0)->count();
      return $answer ;
    }

    function fileFellowScore($activity_id){
      return FilesEvaluation::where('activity_id',$activity_id)->where('fellow_id',$this->id)->first();
    }
    function FellowScoreActivity($user_id,$quizInfo_id){
      return FellowScore::where('questionInfo_id',$quizInfo_id)->where('user_id',$user_id)->first();
    }

    function FellowFileUp($user_id,$activity_id){
      return FellowFile::where('activity_id',$activity_id)->where('user_id',$user_id)->first();
    }

    function total_participations($program_id){
      $forums   = Forum::where('program_id',$program_id)->where('type','activity')->pluck('id')->toArray();
      return      ForumLog::whereIn('forum_id',$forums)->where('user_id',$this->id)->where('type','fellow')->distinct('forum_id')->count('forum_id');
    }

    function total_average($program_id){
      return FellowAverage::where('user_id',$this->id)->where('program_id',$program_id)->where('type','final')->first();
    }
    function module_average($module_id){
      return FellowAverage::where('user_id',$this->id)->where('module_id',$module_id)->where('type','module')->first();
    }

    function session_average($session_id){
      return FellowAverage::where('user_id',$this->id)->where('session_id',$session_id)->where('type','session')->first();
    }

    function forum_participation(){
      $forum  = new Forum();
      return  $forum->check_participation($this->user_id);

    }

    function all_participation_session($session){
      $progress = FellowProgress::where('session_id',$session->id)->where('type','forum')->where('fellow_id',$this->id)->where('status',1)->get();
      if($session->all_forum->count() == $progress->count()){
        return true;
      }else{
        return false;
      }
    }

    function fellow_perception(){
      return $this->hasOne("App\Models\FellowSurvey");
    }


    function fellow_survey($quiz_id){
      return CustomFellowAnswer::where('user_id',$this->id)->where('questionnaire_id',$quiz_id)->get();
    }

    function fellow_survey_custom($quiz_id){
      return CustomFellowAnswer::where('user_id',$this->id)->where('questionnaire_id',$quiz_id);
    }

    function facilitator_survey($session_id,$user_id,$facilitator_id){
      $survey = FacilitatorSurvey::where('user_id', $user_id)->where('session_id',$session_id)->where('facilitator_id',$facilitator_id)->first();
      return $survey;
    }

    function facilitators_survey(){
      return $this->hasMany("App\Models\FacilitatorSurvey");
    }

    public function isOnline()
    {
        return Cache::has('user-is-online-' . $this->id);
    }

    function programs(){
      return $this->hasMany("App\Models\FellowProgram");
    }

    function actual_program(){
      $programs = $this->programs()->pluck('program_id');
    //  $today  = date('Y-m-d');
    //  return Program::where('start','<=',$today)->where('end','>=',$today)->where('public',1)->whereIn('id',$programs->toArray())->first();
      return Program::where('public',1)->whereIn('id',$programs->toArray())->orderBy('start','asc')->first();
    }

    function fac_program(){
      return Program::where('public',1)->orderBy('start','desc')->first();
    }

    function get_total_score($program_id){
      $program      = Program::where('id',$program_id)->first();
      $activities   = $program->get_all_eva_activities()->pluck('id')->toArray();
      $total        = $program->get_all_eva_activities()->count();
      $quiz_id      = QuizInfo::whereIn('activity_id',$activities)->pluck('id')->toArray();
      $fellowScores = FellowScore::where('user_id',$this->id)->whereIn('questionInfo_id',$quiz_id)->get();
      $fileScores   = FilesEvaluation::whereIn('activity_id',$activities)->where('fellow_id',$this->id)->get();
      $score  = 0;
      foreach ($fellowScores as $fscore) {
          $score = $score + $fscore->score;
      }
      foreach ($fileScores as $ffscore){
          $score = $score + $ffscore->score;
      }
      if($total!= 0){
        $average = $score/$total;
      }else{
        $average = 0;
      }
      return $average;
    }

    function get_conversations($program=false){
      if($this->type ==='fellow'){
        $program        = $this->actual_program();
      }
      $storaged       = StoreConversation::where('user_id',$this->id)->pluck('conversation_id')->toArray();
      return  Conversation::where('program_id',$program->id)->where('user_id',$this->id)->whereNotIn('id',$storaged)->orWhere(function($query)use($storaged,$program){
        $query->where('program_id',$program->id)->where('to_id',$this->id)->whereNotIn('id',$storaged);
      })
      ->orderBy('created_at','desc');

    }

    function get_storaged_conversations($program=false){
      if($this->type ==='fellow'){
        $program        = $this->actual_program();
      }
      $storaged      = StoreConversation::where('user_id',$this->id)->pluck('conversation_id')->toArray();
      return Conversation::where('program_id',$program->id)->where('user_id',$this->id)->whereIn('id',$storaged)
      ->orWhere(function($query)use($storaged,$program){
        $query->where('program_id',$program->id)->where('to_id',$this->id)->whereIn('id',$storaged);
      })
      ->orderBy('created_at','desc');

    }

    function get_all_users_for_messages($program=false){
      if($this->type ==='fellow'){
        $program        = $this->actual_program();
      }
      $modules      = $program->fellow_modules()->pluck('id')->toArray();
      $assign_users = FacilitatorModule::whereIn('module_id',$modules)->pluck('user_id')->toArray();
      $disabled     = $this::where('type','fellow')->where('enabled',0)->pluck('id')->toArray();
      $fellows      = FellowProgram::where('user_id','!=',$this->id)->where('program_id',$program->id)->whereNotIn('user_id',$disabled)->pluck('user_id')->toArray();
      $users        = $this::whereIn('id',$fellows)
      ->orwhere(function($query)use($assign_users){
        $query->whereIn('id',$assign_users)->where('enabled',1);
      })->orderBy('name','asc')->get();
      $names = [];
      foreach ($users as $p) {
        if(isset($p->fellowData)){
          $names[$p->id] = $p->name.' '.$p->fellowData->surname." ".$p->fellowData->lastname;
        }elseif(isset($p->facilitatorData)){
            $names[$p->id] = $p->name.' '.$p->facilitatorData->surname." ".$p->facilitatorData->lastname;
        }else{
            $names[$p->id] = $p->name;
        }
      }
      $names[null] = "Selecciona una opción";
      return $names;

    }

    function store_conversations(){
      return $this->hasMany("App\Models\StoreConversation");
    }

    function check_progress($slug,$type){
      $today = date('Y-m-d');
      //habilita modulos, sesiones y actividades
      switch ($type) {
        case 0:
          if($module  = Module::where('slug',$slug)->where('start','<=',$today)->where('public',1)->first()){
              return $this->check_module($module);
          }else{
              return false;
          }

        break;

        case 1:
          // session
          if($session  = ModuleSession::where('slug',$slug)->first()){
            return $this->check_session($session);
          }else{
            return false;
          }

        break;

        case 2:
          // activity
          if($activity  = Activity::where('slug',$slug)->first()){
            return $this->check_activity($activity);
          }else{
            return false;
          }
        break;

        default:
          return false;
        break;
      }
    }

    //Verificar que se pueda accesar al módulo
    function check_module($module){
      $today = date('Y-m-d');
      $parent = Module::where('id',$module->parent_id)->where('start','<=',$today)->where('public',1)->first();
      if($parent){
        if(FellowProgress::where('fellow_id',$this->id)->where('type','module')->where('module_id',$module->parent_id)->where('status',1)->first()){
            //se busca registro de que ha completado el módulo "padre"
            return true;
        }else{
            return false;
        }
      }else{
        //primer modulo
        return true;

      }
    }


    function check_session($session){
    if($this->check_progress($session->module->slug,0)){
      if($parent = $session->parent){
        if($parent->activity_eval()->count() > 0){
            //se busca registro de que ha completado la sesión "padre"
            if(FellowProgress::where('fellow_id',$this->id)->where('session_id',$session->parent_id)->where('type','session')->where('status',1)->first()){
              return true;
            }else{
              return false;
            }
        }else{
          return true;
        }

      }else{
        return true;
      }
    }else{
      return false;
    }

    }

    function check_activity($activity){
      if($activity->session){
          if($this->check_progress($activity->session->slug,1)){
            return true;

          }else{
            return false;
          }
      }else{
        return false;
      }
    }



    function facilitator_actual_sessions(){
      $today        = date('Y-m-d');
      $program      = Program::where('public',1)->where('end','>=',$today)->first();
      if($program){
        $sessions_ids = $program->get_all_fellow_sessions()->pluck('id')->toArray();
      }else{
        $sessions_ids = [];
      }
      return  FacilitatorModule::where('user_id',$this->id)->whereIn('session_id',$sessions_ids);
    }

    function update_progress($module){
      //$this->update_forum_progress($module->id);
      $allev  = $module->get_all_evaluation_activity();
      $allfr  = $module->get_all_activities_with_forums();
      $allFeP = FellowProgress::where('fellow_id',$this->id)->where('module_id',$module->id)
                ->where('status',1)
                ->whereIn('activity_id',$allev->pluck('id')->toArray())
                ->where('type','activity')->get();
      $allFfP = FellowProgress::where('fellow_id',$this->id)->where('module_id',$module->id)
                ->where('status',1)
                ->whereIn('activity_id',$allfr->pluck('id')->toArray())
                ->where('type','forum')->get();
     $fp = FellowProgress::firstOrCreate(
                ['fellow_id' => $this->id,
                  'program_id' => $module->program->id,
                  'module_id'  => $module->id,
                  'type'       => 'module'
                ]);

      $fp->status = 1;
      $fp->save();

      if($allev->count() > 0 || $allfr->count() > 0 ){
        if($allev->count() != $allFeP->count() && $allev->count() > 0){
          $fp->status = 0;
          $fp->save();

        }

        if($allfr->count() > 0 ){
          if($allFfP->count() != $allfr->count() && $allfr->count() > 0 ){
            $fp->status = 0;
            $fp->save();
          }
      }
    }



      foreach ($module->sessions as $session) {
        $allSev  = $session->activity_eval();
        $allSfr  = $session->all_forum;
        $allFeP = FellowProgress::where('fellow_id',$this->id)
                  ->where('session_id',$session->id)
                  ->where('status',1)
                  ->whereIn('activity_id',$allSev->pluck('id')->toArray())
                  ->where('type','activity')->get();
        $allFfP = FellowProgress::where('fellow_id',$this->id)
                  ->where('session_id',$session->id)
                  ->where('status',1)
                  ->whereIn('activity_id',$allSfr->pluck('activity_id')->toArray())
                  ->where('type','forum')->get();
        $fp_s = FellowProgress::firstOrCreate(
                ['fellow_id' => $this->id,
                    'program_id' => $module->program->id,
                    'module_id'  => $module->id,
                    'session_id' => $session->id,
                    'type'       => 'session'
                ]);

        $fp_s->status = 1;
        $fp_s->save();
        if($allSev->count() > 0 || $allSfr->count() > 0 ){
            if($allSev->count() != $allFeP->count() && $allSev->count() > 0){
                $fp_s->status = 0;
                $fp_s->save();
            }

            if($allSfr->count() != $allFfP->count() && $allSfr->count() > 0){
              $fp_s->status = 0;
              $fp_s->save();
              }
        }
      }
      return true;

    }

    function update_module_progress($module_slug){
      $today = date('Y-m-d');
      if($module = Module::where('slug',$module_slug)->where('start','<=',$today)->where('public',1)->first()){
        if($module->get_all_evaluation_activity_and_forum()->count() > 0){
          $save_module = true;
          $fp_m = FellowProgress::firstOrCreate(
            ['fellow_id' => $this->id,
            'program_id' => $module->program->id,
            'module_id'  => $module->id,
            'type'       => 'module'
            ]);
          foreach ($module->sessions as $session) {
              if($session->activity_eval_and_forum()->count() > 0){

                 foreach ($session->activity_eval_and_forum() as $activity) {
                   $next = true;
                   $fp =  FellowProgress::firstOrCreate(
                       ['fellow_id' => $this->id,
                        'program_id' => $module->program->id,
                        'module_id'  => $module->id,
                        'session_id' => $session->id,
                        'type'       => 'session'
                        ]);
                    if($activity->hasforum){
                      if($activity->type=== 'evaluation'){
                        if(!FellowProgress::where('fellow_id',$this->id)->where('activity_id',$activity->id)->where('status',1)->where('type','activity')->first()){
                          $fp->status = 0;
                          $fp->save();
                          $next = false;
                          $save_module = false;
                          break;
                        }
                      }
                      if(!FellowProgress::where('fellow_id',$this->id)->where('activity_id',$activity->id)->where('status',1)->where('type','forum')->first()){
                        $fp->status = 0;
                        $fp->save();
                        $next = false;
                        $save_module = false;
                        break;
                      }
                    }else{
                      if(!FellowProgress::where('fellow_id',$this->id)->where('activity_id',$activity->id)->where('status',1)->where('type','activity')->first()){
                        $fp->status = 0;
                        $fp->save();
                        $next = false;
                        $save_module = false;
                        break;
                      }
                    }
                    if($next){
                      $fellowAverage = FellowAverage::firstOrCreate([
                                  'user_id'    => $this->id,
                                  'module_id'  => $session->module->id,
                                  'session_id' => $session->id,
                                  'type'       => 'session',
                                  'program_id' => $session->module->program->id
                                ]);
                      $fellowAverage->scoreSession();
                      $fp->status = 1;
                      $fp->save();
                    }
                 }


              }else{
               $fp =  FellowProgress::firstOrCreate(
                   ['fellow_id' => $this->id,
                    'program_id' => $module->program->id,
                    'module_id'  => $module->id,
                    'session_id' => $session->id,
                    'type'       => 'session'
                    ]);
                $fp->status = 1;
                $fp->save();
              }
          }

        if($save_module){
          $fp_m->status = 1;
          $fp_m->save();
          return true;
        }else{
          $fp_m->status = 0;
          $fp_m->save();
          return false;
        }
        }else{
            $fp = FellowProgress::firstOrCreate(
              ['fellow_id' => $this->id,
              'program_id' => $module->program->id,
              'module_id'  => $module->id,
              'type'       => 'module'
              ]);
            $fp->status = 1;
            $fp->save();
            foreach ($module->sessions as $session) {
              $fp =  FellowProgress::firstOrCreate(
                  ['fellow_id' => $this->id,
                   'program_id' => $module->program->id,
                   'module_id'  => $module->id,
                   'session_id' => $session->id,
                   'type'       => 'session'
                   ]);
               $fp->status = 1;
               $fp->save();
            }
        }
        return true;
      }else{
        return false;
      }

    }

    function actual_module(){
      $program     = $this->actual_program();
      $modules     = $program->fellow_modules;
      $last_module = $modules->first();
      foreach ($modules as $module) {
        if($this->check_progress($module->slug,0)){
          $last_module = $module;
        }else{
          break;
        }
      }

      return $last_module;


    }

    function unread_messages($program=null){
      if($this->type==='fellow'){
        $program = $this->actual_program();
      }
      $conversations = Conversation::where('program_id',$program->id)->pluck('id')->toArray();
      $messages      = Message::where('to_id',$this->id)->whereIn('conversation_id',$conversations)->pluck('id')->toArray();
      return ConversationLog::where('status',0)->whereIn('message_id',$messages)->get();
    }

    function update_forum_progress($module_id){
      $module = Module::find($module_id);
      if($module){
        foreach ($module->get_all_activities_with_forums() as $act) {
            if($act->hasforum){
              if($act->forum->check_participation($this->id) || $this->email == 'andre@fcb.com'){
                $fellowProgress  = FellowProgress::firstOrCreate([
                  'fellow_id'    => $this->id,
                  'module_id'    => $act->forum->session->module->id,
                  'session_id'   => $act->forum->session->id,
                  'activity_id'  => $act->id,
                  'program_id'   => $act->forum->session->module->program->id,
                  'type'         => 'forum',
                ]);
                $fellowProgress->status = 1;
                $fellowProgress->save();
              }
            }
        }
      }
      return true;
    }

    function complete_modules($program_id){
      return FellowProgress::where('status',1)->where('type','module')->where('fellow_id',$this->id)->where('program_id',$program_id)->get();
    }

    function complete_module($module_id){
      return FellowProgress::where('status',1)->where('type','module')->where('fellow_id',$this->id)->where('module_id',$module_id)->first();
    }

    function complete_session($session_id){
     return FellowProgress::where('status',1)->where('type','session')->where('fellow_id',$this->id)->where('session_id',$session_id)->first();
    }

    function check_diagnostic($activity_id){
     $activity  = Activity::find($activity_id);
     if($activity->diagnostic_info){
       $answers = CustomFellowAnswer::where('questionnaire_id',$activity->diagnostic_info->id)->where('user_id',$this->id)->count();
       if($answers== $activity->diagnostic_info->questions->count()){
         return true;
       }else{
         return false;
       }

     }else{
       return false;
     }
    }



}
