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

  function fellowScore($questionInfo_id,$user_id){
    return FellowScore::where('questionInfo_id',$questionInfo_id)->where('user_id',$user_id)->first();
  }



  function get_pagination(){
    $program  = $this->session->module->program;
    $sessions_with_activities =  Activity::select('session_id')->distinct('session_id')->pluck('session_id')->toArray();
    $sessions_with_activities =  $program->get_all_sessions()->whereIn('id',$sessions_with_activities)->orderBy('order','asc')->pluck('id')->toArray();
    $index = array_search($this->session->id, $sessions_with_activities);
    if($index !== FALSE)
    {
      if($index+1 < sizeof($sessions_with_activities)){
        $next = $sessions_with_activities[$index + 1];
        $sess = ModuleSession::find($next);
        $next = $sess->activities()->first()->id;
      }else{
        $next = false;
      }

      if($index-1 >= 0){
        $prev = $sessions_with_activities[$index - 1];
        $sess = ModuleSession::find($prev);
        $prev = $sess->activities()->first()->id;
      }else{
        $prev = false;
      }


    }
    return array($prev,$next);

  }

}
