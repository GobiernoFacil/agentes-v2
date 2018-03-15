<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Cache;
use App\Notifications\MyResetPassword;
use App\Models\FellowAnswer;
use App\Models\Aspirant;
use App\Models\FilesEvaluation;
use App\Models\FellowScore;
use App\Models\FellowFile;
use App\Models\FacilitatorSurvey;
use App\Models\Forum;
use App\Models\ForumLog;
use App\Models\FellowAverage;
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

    function store_conversations(){
      return $this->hasMany("App\Models\StoreConversation");
    }

    function diagnostic(){
      return $this->hasOne("App\Models\DiagnosticAnswer");
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

    function fileFellowScore($fellow_id,$activity_id){
      return FilesEvaluation::where('activity_id',$activity_id)->where('fellow_id',$fellow_id)->first();
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
      return FellowAverage::where('user_id',$this->id)->where('program_id',$program_id)->where('type','total')->first();
    }
    function module_average($user_id,$module_id){
      return FellowAverage::where('user_id',$user_id)->where('module_id',$module_id)->first();
    }
    function session_average($user_id,$session_id){
      return FellowAverage::where('user_id',$user_id)->where('session_id',$session_id)->first();
    }
    function forum_participation($user_id,$session_id){
      $fellowAverage  = new FellowAverage();
      return  $fellowAverage->get_forum_participation($session_id,$user_id);

    }

    function fellow_survey(){
      return $this->hasOne("App\Models\FellowSurvey");
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
      $today  = date('Y-m-d');
      return Program::where('start','<=',$today)->where('end','>=',$today)->where('public',1)->whereIn('id',$programs->toArray())->first();

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

}
