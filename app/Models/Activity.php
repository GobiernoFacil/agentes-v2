<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\FellowScore;
use App\Models\ModuleSession;
class Activity extends Model
{
    //

    protected $fillable = [
      'session_id',
      'order',
      'name',
      'description',
      'facilitator_role',
      'competitor_role',
      'duration',
      'slug',
      'type',
      'files',
      'evaluation',
      'hasfiles',
      'hasforum',
      'end',
      'measure'
    ];

    //modelos relacionados
  function session(){
    return $this->belongsTo("App\Models\ModuleSession");
  }

  function activityRequirements(){
    return $this->hasMany("App\Models\ActivityRequirement")->orderBy('order','asc');
  }

  function activityFiles(){
    return $this->hasMany("App\Models\ActivitiesFile");
  }

  function videos(){
    return $this->hasOne("App\Models\ActivityVideo");
  }

  function forum(){
    return $this->hasOne("App\Models\Forum");
  }

  function quizInfo(){
    return $this->hasOne("App\Models\QuizInfo");
  }

  function diagnostic_info(){
    return $this->hasOne("App\Models\CustomQuestionnaire");
  }

  function fellowFileScore($user_id){
    return FilesEvaluation::where('activity_id',$this->id)->where('fellow_id',$user_id)->first();
  }

  function diagnosticInfo(){
    return $this->hasOne("App\Models\CustomQuestionnaire");
  }

  function fellowScore($user_id){
    return FellowScore::where('questionInfo_id',$this->quizInfo->id)->where('user_id',$user_id)->first();
  }



  function get_pagination(){
    $control_same_session_next = true;
    $control_same_session_prev = true;
    $prev = false;
    $next = false;
    $module  = $this->session->module;
    $sessions_with_activities =  Activity::select('session_id')->distinct('session_id')->pluck('session_id')->toArray();
    $sessions_with_activities =  $module->sessions()->whereIn('id',$sessions_with_activities)->orderBy('order','asc')->pluck('id')->toArray();
    $index = array_search($this->session->id, $sessions_with_activities);

    if($this->session->activities()->where('order','>=',$this->order+1)->first()){
      $next =$this->session->activities()->where('order','>=',$this->order+1)->first()->id;
    }else{
      $control_same_session_next = false;
    }
    if($this->session->activities()->where('order','<=',$this->order-1)->orderBy('order','desc')->first()){
      $prev =$this->where('session_id',$this->session_id)->where('order','<=',$this->order-1)->orderBy('order','desc')->first()->id;
    }else{
      $control_same_session_prev = false;
    }


    if($index !== FALSE)
    {
        if(!$control_same_session_next){
          //cambio de sesión next
          if($index+1 < sizeof($sessions_with_activities)){
            $next = $sessions_with_activities[$index + 1];
            $sess = ModuleSession::find($next);
            $next = $sess->activities()->first()->id;
          }
        }
      if(!$control_same_session_prev){
          //cambio de sesión prev
          if($index-1 >= 0){
            $prev = $sessions_with_activities[$index - 1];
            $sess = ModuleSession::find($prev);
            $prev = $this->where('session_id',$sess->id)->orderBy('order','desc')->first()->id;
          }
        }
    }
    return array($prev,$next);

  }


  function reorder_add($request,$session){
    $activities  = $session->activities;
    if($request->order ==='first'){
      $order = 2;
      foreach ($activities as $activity) {
        $activity->order = $order++;
        $activity->save();
      }
      return 1;

    }elseif($request->order ==='last'){
      $order_act =1;
      $order =1;
      foreach ($activities as $activity) {
        $activity->order = $order++;
        $activity->save();
        $order_act = $activity->order;
      }
      return $order_act+1;

    }else{
      $order = $request->order+1;
      $order_act =$request->order+1;
      foreach ($activities as $activity) {
        if($activity->order>=$order_act){
          $activity->order++;
          $activity->save();
        }
      }

      return $order_act;

    }
    return 0;
  }

  function count_fellow_evaluations(){
    if($this->quizInfo){
      return FellowScore::where('user_id','!=',50000)->where('questionInfo_id',$this->quizInfo->id)->whereNotNull('score')->count();
    }else{
      return false;
    }
  }

  function count_fellow_file_evaluations(){
    return FellowFile::where('user_id','!=',50000)->where('activity_id',$this->id)->count();
  }

  function count_fellow_diagnostic(){
    return CustomFellowAnswer::select('user_id')->where('user_id','!=',50000)->where('questionnaire_id',$this->diagnosticInfo->id)->distinct('user_id')->count('user_id');
  }

}
