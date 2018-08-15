<?php

namespace App\Models;
use Auth;
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
    'program_id'
    ];
    //porcentajes de ponderacion de acuerdo
    const ACT_VALUE = .8;
    const FORUM_VALUE  = .2;
    const All_MODULES  = .2;
    const ATTENDANCE   = .3;
    const FINAL_WORK   = .5;

    //modelos relacionados
    function module(){
      return $this->belongsTo("App\Models\Module");
    }

    function program(){
      return $this->belongsTo("App\Models\Program");
    }


    function session(){
      return $this->belongsTo("App\Models\ModuleSession");
    }

    function user(){
      return $this->belongsTo("App\User");
    }
    /**
     * Calcula calificacion total del programa
     *
     * @return \Illuminate\Http\Response
     */
    function scoreProgram($user_id)
    {
      if($this->type != 'final'){
        $total_program_score = FellowAverage::firstOrCreate([
          'user_id'    => $user_id,
          'type'       => 'final',
          'program_id' => $this->module->program->id
        ]);
        $program       = $total_program_score->program;
      }else{
        $program       = $this->program;
      }

      if($final = $program->final_fellow_evaluation()){
        //existe evaluacion final
        $today = date('Y-m-d');
        if($final->end <= $today){
            $score_modules   = FellowAverage::where('user_id',$user_id)->where('type','total_module')->where('program_id',$program->id)->first();
            if($score_modules->average){
              $score_modules = $score_modules->average*self::All_MODULES;
            }else{
              $score_modules = 0;
            }
            $score_attendace = 10*self::ATTENDANCE;
            if($this->type != 'final'){
              $total_program_score->average     = $this->user->fileFellowScore($final->id)->score*self::FINAL_WORK + $score_modules + $score_attendace;
              $total_program_score->save();
            }elseif($this->type === 'final'){
              $this->average      = $this->user->fileFellowScore($final->id)->score*self::FINAL_WORK + $score_modules + $score_attendace;
              $this->save();
            }
        }else{
          if($score   = FellowAverage::where('user_id',$user_id)->where('type','total_module')->where('program_id',$program->id)->first()){
            if($this->type != 'final'){
              $total_program_score->average = $score->average;
              $total_program_score->save();
              return true;
            }else{
              $this->average  = $score->average;
              $this->save();
              return true;
            }
          }else{
            return true;
          }
        }
      }else{
        //la calificacion es el promedio de los modulos
        if($score   = FellowAverage::where('user_id',$user_id)->where('type','total_module')->where('program_id',$program->id)->first()){
          if($this->type != 'final'){
            $total_program_score->average = $score->average;
            $total_program_score->save();
          }else{
            $this->average  = $score->average;
            $this->save();
            return true;
          }
        }else{
          return true;
        }

      }

    }

    /**
     * Calcula calificacion total de modulos del programa y actualiza calificacion del programa
     *
     * @return \Illuminate\Http\Response
     */
    function scoreAllModules($user_id)
    {
      $total_module_score = FellowAverage::firstOrCreate([
        'user_id'    => $user_id,
        'type'       => 'total_module',
        'program_id' => $this->module->program->id
      ]);
      $program       = $total_module_score->program;
      $scores        = FellowAverage::whereNotNull('average')->where('user_id',$user_id)->where('type','module')->whereIn('module_id',$program->fellow_modules->pluck('id')->toArray())->where('program_id',$program->id)->get();
      $total_scores  = FellowAverage::whereNotNull('average')->where('user_id',$user_id)->where('type','module')->whereIn('module_id',$program->fellow_modules->pluck('id')->toArray())->where('program_id',$program->id)->sum('average');
      if($total_scores  > 0){
        $total_module_score->average = $total_scores/$scores->count();
        $total_module_score->save();
        $this->scoreProgram($user_id);
      }else{
        //nada que actualizar
        return true;
      }
    }

    /**
     * Calcula calificacion del modulo y actualiza calificaciones generales
     *
     * @return \Illuminate\Http\Response
     */
    function scoreModule($user_id)
    {
      $module_score = FellowAverage::firstOrCreate([
        'user_id'    => $user_id,
        'module_id'  => $this->module->id,
        'type'       => 'module',
        'program_id' => $this->module->program->id
      ]);

      $module       = $module_score->module;
      $sessions_with_diagnostic = [];
      $scores       = FellowAverage::whereNotNull('average')->whereNotIn('session_id',$sessions_with_diagnostic)->where('user_id',$user_id)->where('type','session')->whereIn('session_id',$module->sessions->pluck('id')->toArray())->where('program_id',$module->program->id)->get();
      $total_scores = FellowAverage::whereNotNull('average')->whereNotIn('session_id',$sessions_with_diagnostic)->where('user_id',$user_id)->where('type','session')->whereIn('session_id',$module->sessions->pluck('id')->toArray())->where('program_id',$module->program->id)->sum('average');
      if($total_scores  > 0){
        $module_score->average = $total_scores/$scores->count();
        $module_score->save();
        $this->scoreAllModules($user_id);
      }else{
        //nada que actualizar
        $module_score->average = null;
        $module_score->save();
        return true;
      }

    }

    /**
     * calcula calificacion de la sesion
     * La calificacion se calcula mediante las constantes ACT_VALUE, FORUM_VALUE
     * Si no existen actividades del tipo de ponderación, la calificacion es el total del único tipo de actividad que exista
     * @return \Illuminate\Http\Response
     */
    function scoreSession()
    {

       $act_score = $this->all_activities_score_by_session($this->session,$this->user_id);
       $score = 0;
       if($act_score){
         if($for_score = $this->score_all_forums_participation($this->session,$this->user_id)){
            //existen foros y evaluaciones
            $score_act = $act_score['score']*self::ACT_VALUE;
            $score_for = $for_score['score']*self::FORUM_VALUE;
            $score = $score_act + $score_for;

         }else{
           //solo existen actividades evaluacion
           $score = $act_score['score'];
         }
       }else{
         if($for_score = $this->score_all_forums_participation($this->session,$this->user_id)){
           //solo existen foros
           $score = $for_score['score'];
         }
       }
       if(!$act_score && !$for_score){
         $this->average = null;
         $this->save();
       }else{
         $this->average = $score;
         $this->save();
       }

       $this->scoreModule($this->user_id);
       return true;
    }


    function all_activities_score_by_session($session,$user_id){
      $ev_activities = $session->activities_kardex_fellow($user_id);
      if($ev_activities->count()>0){
        $total_score = 0;
        $act_count   = 0;
        foreach ($ev_activities as $_activity) {
          if($_activity->files){
            if($this->user->fellowFiles()->where('activity_id',$_activity->id)){
              if($score = $_activity->fellowFileScore($user_id)){
                 $total_score = $total_score + $score->score;
                 $act_count++;
              }
            }else{
                $act_count++;
            }


          }else{
            if($score = $_activity->fellowScore($user_id )){
              $total_score = $total_score + $score->score;
            }
            $act_count++;

          }
        }

        if($act_count == 0){
          return false;
        }else{
          return array('act_number' => $ev_activities->count(), 'score'=>$total_score/$act_count);
        }


      }else{
        return false;
      }
    }

    function score_all_forums_participation($session,$user_id){
      $forums   = $session->activity_forum_kardex($user_id);
      if($forums->count()>0){
        $total_score = 0;
        foreach ($forums as $forum){
            if($forum->check_participation($user_id)){
              $total_score = $total_score+10;
            }
        }
        return array('for_number' => $forums->count(), 'score'=>$total_score/$forums->count());
      }else{
        return false;
      }
    }




}
