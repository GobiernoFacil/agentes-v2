<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Activity;
use App\Models\FellowScore;
use App\Models\FilesEvaluation;
use App\Models\FellowAverage;
use App\Models\ForumLog;
use App\Models\Forum;
use App\Models\Module;
use App\Models\ModuleSession;

class FellowAverage extends Model
{
    //
    public $table = 'fellow_averages';
    protected $fillable = [
    'user_id',
    'module_id',
    'session_id',
    'type',
    'average',
    ];

    /**
     * calcula promedio del modulo de acuerdo a id e id de usuario
     *
     * @return \Illuminate\Http\Response
     */
    function scoreModule($module_id,$fellow_id)
    {
      $today = date("Y-m-d");
      $sessions_id = ModuleSession::where('module_id',$module_id)->where('start','<=',$today)->pluck('id');
      //obtener id de sesiones que cuenten con evaluaciones automaticas o de archivos
      $activities_id = Activity::where('type','evaluation')->whereIn('session_id',$sessions_id->toArray())->pluck('session_id');
      $forums_id     = Forum::whereIn('session_id',$sessions_id->toArray())->pluck('session_id');
      $ids = array_unique(array_merge($activities_id->toArray(),$forums_id->toArray()));
      $total_score = 0;
      $sessions  = ModuleSession::whereIn('id',$ids)->get();
      foreach($sessions as $session){
           $session_score = FellowAverage::where('session_id',$session->id)->where('user_id',$fellow_id)->first();
           if($session_score){
             $total_score = $session_score->average + $total_score;
           }
        }

      $fellow_average = FellowAverage::firstOrCreate(['user_id'=>$fellow_id,'module_id'=>$module_id]);
      if($sessions->count()>0){
          $fellow_average->type= 'module';
          $fellow_average->average = $total_score/($sessions->count());
      }else{
          $fellow_average->type= 'sin';
          $fellow_average->average= null;
      }
      $fellow_average->save();
      $this->score($fellow_id);
      return true;
    }

    /**
     * calcula promedio de la sesion
     * La calificacion se calcula 30% evaluaciones, 40% archivos y 30% participaciones
     * Si no existen actividades del tipo de ponderación, se ajustan de acuerdo a los porcentajes centrales
     * @return \Illuminate\Http\Response
     */
    function scoreSession($activity_id=null,$fellow_id,$session_id=null)
    {
      if(!$session_id){
        $activity = Activity::find($activity_id);
        $session  = $activity->session;
      }else{
        $session = ModuleSession::find($session_id);
      }
      //Checar actividades con archivos
      $file_count = Activity::where('type','evaluation')->where('files','Sí')->where('session_id',$session->id)->count();
      if($file_count>0){
        $files_score = $this->get_files_activities($session->id,$fellow_id);
      }else{
        $files_score = 'None';
      }
      //Checar actividades con evaluaciones
      $eva_count = Activity::where('type','evaluation')->where('files','No')->where('session_id',$session->id)->count();
      if($eva_count>0){
        $eva_score = $this->get_evaluation_activities($session->id,$fellow_id);
      }else{
        $eva_score = 'None';
      }
      //Checar participación en foros
      $forum_count = Forum::where('session_id',$session->id)->count();
      if($forum_count>0){
        $forum_score = $this->get_forum_participation($session->id,$fellow_id);
      }else{
        $forum_score = 'None';
      }
      $fellow_average = FellowAverage::firstOrCreate(['user_id'=>$fellow_id,'session_id'=>$session->id]);
      if(gettype($files_score) === 'string' && gettype($eva_score) === 'string' && gettype($forum_score) === 'string'){
        $fellow_average->type = 'sin';
        $fellow_average->average= null;
      }else{
        $final_score = $this->get_session_score($files_score,$eva_score,$forum_score);
        $fellow_average->average = $final_score;
      }
      $fellow_average->save();
      $this->scoreModule($session->module_id,$fellow_id);
      return true;
    }

    /**
     * calcula promedio total para id de usuario
     *
     * @return \Illuminate\Http\Response
     */
    function score($fellow_id)
    {
      $today = date("Y-m-d");
      $modules = Module::where('start','<=',$today)->get();
      $total_score = 0;
      foreach($modules as $module){
        $score = FellowAverage::where('module_id',$module->id)->where('user_id',$fellow_id)->first();
        if($score){
          $total_score = $total_score + $score->average;
        }
      }

      $fellow_average = FellowAverage::firstOrCreate(['user_id'=>$fellow_id,'type'=>'total']);
      if($modules->count()>0){
        $fellow_average->average= $total_score/($modules->count());
      }else{
        $fellow_average->average= 0;
      }
      $fellow_average->save();
      return true;
    }

    /**
     * calcula promedio de actividades con archivos para el id de la sesión y usuario
     *
     * @return \Illuminate\Http\Response
     */
    function get_files_activities($session_id,$fellow_id){
      $file_activities_ids = Activity::where('type','evaluation')->where('files','Sí')->where('session_id',$session_id)->pluck('id');
      $scores              = FilesEvaluation::where('fellow_id',$fellow_id)->whereIn('activity_id',$file_activities_ids->toArray())->get();
      $total_score = 0;
      if($scores->count()>0){
        foreach($scores as $score){
          $total_score = $total_score + $score->score;
        }
        return $total_score/($scores->count());
      }else{
        return $total_score;
      }
    }

    /**
     * calcula promedio de actividades con evaluaciones para el id de la sesión y usuario
     *
     * @return \Illuminate\Http\Response
     */
    function get_evaluation_activities($session_id,$fellow_id){
      $activities = Activity::where('type','evaluation')->where('files','No')->where('session_id',$session_id)->get();
      $total_score = 0;
      foreach($activities as $activity){
        if($activity->QuizInfo){
            $score = FellowScore::where('questionInfo_id',$activity->QuizInfo->id)->where('user_id',$fellow_id)->first();
            if($score){
              $total_score = $total_score + $score->score;
            }
        }
      }

      if($activities->count()>0){
        return $total_score/($activities->count());
      }else{
        return $total_score;
      }
    }

    /**
     * calcula promedio de participación en los foros de la sesión para el id del usuario
     *
     * @return \Illuminate\Http\Response
     */
    function get_forum_participation($session_id,$fellow_id){
      $forums = Forum::where('session_id',$session_id)->get();
      $total_score = 0;
      foreach($forums as $forum){
        $participation = ForumLog::where('forum_id','user_id',$fellow_id)->where('type','fellow')->first();
        if($participation){
          $total_score = $total_score +10;
        }
      }

      if($forums->count()>0){
        return $total_score/($forums->count());
      }else{
        return $total_score;
      }

    }

    /**
     * calcula promedio de sesion de acuerdo a las tres calificaciones
     *
     * @return \Illuminate\Http\Response
     */

     function get_session_score($files_score,$eva_score,$forum_score){
         $total_score = 0;
       if(gettype($files_score) === 'integer' && gettype($eva_score) === 'integer' && gettype($forum_score) === 'integer'){
         $total_score = (($files_score*4)/10) + (($eva_score*3)/10) + (($forum_score*3)/10);
         return $total_score;
       }elseif(gettype($files_score) ==='string' && gettype($eva_score) ==='integer' && gettype($forum_score) === 'integer'){
         $total_score =  (($eva_score*5)/10) + (($forum_score*5)/10);
         return $total_score;
       }elseif(gettype($files_score ==='integer') && (gettype($eva_score) ==='string' || gettype($forum_score) === 'string')){
         $new_max_files = ((4*10)/7);
         $new_max_other = ((3*10)/7);
         if(gettype($eva_score) ==='string'){
          $total_score =  (($eva_score*$new_max_other)/10) + (($files_score*$new_max_files)/10);
         }else{
           $total_score =  (($forum_score*$new_max_other)/10) + (($files_score*$new_max_files)/10);
         }
         return $total_score;
       }else{
         return $total_score;

       }

     }


}
