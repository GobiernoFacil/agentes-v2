<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use File;
// models
use App\Models\Activity;
use App\Models\ActivityVideo;
use App\Models\Forum;
use App\Models\ForumConversation;
use App\Models\ForumLog;
use App\Models\ModuleSession;
use App\Models\Log;

// FormValidators
use App\Http\Requests\SaveActivity;
use App\Http\Requests\UpdateActivity;
class Activities extends Controller
{
  //Paginación
  public $pageSize = 10;
  // En esta carpeta se guardan las imágenes de los usuarios
  const UPLOADS = "archivos/actividades";



        /**
         * Agregar actividad
         *
         * @return \Illuminate\Http\Response
         */
        public function add($session_id)
        {
            $user       = Auth::user();
            //sesion de la actividad
            $session    = ModuleSession::where('id',$session_id)->firstOrFail();
            //actividades pertenecientes a la actividad
            $activities =  $session->activities()->orderBy('order','asc')->pluck('name','order')->toArray();
            $activities['first'] = 'Primera actividad';
            $activities['last'] = 'Última actividad';
            //verificar que no exista actividad final
            if($session->module->program->final_evaluation()->first()){
              $types      = [null => "Selecciona una opción","diagnostic"=>'Diagnóstico','evaluation'=>'Evaluación', 'lecture' =>'Lectura', 'video'=> 'Video'];
            }else{
              $types      = [null => "Selecciona una opción","diagnostic"=>'Diagnóstico','evaluation'=>'Evaluación', 'final'=>'Evaluación Final','lecture' =>'Lectura', 'video'=> 'Video'];
            }
            return view('admin.modules.activities.activity-add')->with([
              "user"      => $user,
              "session"   => $session,
              "activities" => $activities,
              "types"     => $types
            ]);
        }

        /**
         * Guarda nueva actividad
         *
         * @param  \Illuminate\Http\Request  $request
         * @return \Illuminate\Http\Response
         */
        public function save(SaveActivity $request)
        {
            //
            $user      = Auth::user();
            //sesion de la actividad
            $session   = ModuleSession::where('id',$request->session_id)->firstOrFail();
            $activity  = new Activity($request->except(['_token','time','start','link','order']));
            //re-ordenar actividades
            $activity->order = $activity->reorder_add($request,$session);

           if($request->files && $request->type === 'evaluation'){
              $activity->type = 'evaluation';
            }
            if($request->type === 'final'){
               $activity->files = 1;
             }
            $activity->slug          = str_slug($request->name);
            $activity->session_id    = $session->id;
            $activity->save();
            //activity video data
            if($activity->type==='video'){
              $video  = new ActivityVideo();
              $video->link = $request->link_video;
              $video->activity_id = $activity->id;
              $video->save();
            }
            //webinar type - not used
            if($activity->type==='webinar'){
              $video  = new ActivityVideo($request->only(['start','link','time']));
              $video->activity_id = $activity->id;
              $video->save();
            }
            //actividad cuenta con foro
            if($activity->hasforum){
              $name   = 'Foro de actividad: '.$request->name;
              //agregar numero al final del titulo si se repite nombre del foro en db
              $forum  = new Forum();
              $unique = Forum::select('topic')->where('topic',$name)->distinct()->get();
              if($unique->count()>0){
                $matches = array();
                if (preg_match('#(\d+)$#', $request->name, $matches)) {
                  $number = $matches[1]+1;
                  $name   = $name.' '.$number;
                  $forum->topic = $name;
                  $forum->slug  = str_slug($name);
                }else{
                  $number = 2;
                  $name   = $name.' '.$number;
                  $forum->topic = $name;
                  $forum->slug  = str_slug($name);
                }
              }else{
                $forum->topic = $name;
                $forum->slug  = str_slug($name);
              }
              $forum->session_id = $session->id;
              $forum->activity_id = $activity->id;
              $forum->module_id    = $session->module->id;
              $forum->program_id   = $session->module->program->id;
              $forum->type       = 'activity';
              $forum->user_id    = $user->id;
              $forum->description = $activity->description;
              $forum->save();
            }
            //user log
            $log = Log::firstOrCreate([
              'user_id'     => $user->id,
              'session_id'  => $session->id,
              'module_id'   => $session->module_id,
              'program_id'  => $session->module->program->id,
              'activity_id' => $activity->id,
              'type'        => 'create'
            ]);
            //re-direccionamiento dependiendo del tipo de actividad
            if($activity->hasfiles){
              //Agregar archivos
              return redirect("dashboard/sesiones/actividades/archivos/agregar/$activity->id")->with('success',"Se ha guardado correctamente");
            }elseif($activity->type==='evaluation' && !$activity->files){
              //Agregar evaluacion
              return redirect("dashboard/sesiones/actividades/evaluacion/agregar/$activity->id/1")->with('success',"Se ha guardado correctamente");
            }elseif($activity->type==='diagnostic' && !$activity->files){
              //Agregar diagnostico
              return redirect("dashboard/sesiones/actividades/diagnostico/agregar/$activity->id/1")->with('success',"Se ha actualizado correctamente");
           }else{
             //regresar a ver actividad
              return redirect("dashboard/sesiones/actividades/ver/$activity->id")->with('success',"Se ha actualizado correctamente");
           }
        }

        /**
         * Muestra actividad
         *
         * @param  int  $id
         * @return \Illuminate\Http\Response
         */
        public function view($id)
        {
            //informacion basica
            $user     = Auth::user();
            $activity = Activity::where('id',$id)->firstOrFail();
      			$session  = ModuleSession::where('id',$activity->session_id)->firstOrFail();
            //paginacion de actividades
            $pagination = $activity->get_pagination();
            $prev     = $pagination[0];
            $next     = $pagination[1];
            $forum    = $activity->forum;
            if($activity->forum){
              $forums   = ForumConversation::where('forum_id',$forum->id)->orderBy('created_at','desc')->paginate($this->pageSize);
            }else{
              $forums   = null;
            }
             return view('admin.modules.activities.activity-view')->with([
              "user"      	=> $user,
              "activity"    => $activity,
              "session"		=> $session,
              "forum"		=> $forum,
              "forums"		=> $forums,
              "next"    => $next,
              "prev"    =>$prev
            ]);
        }

        /**
         * Muestra contenido para actualizar una actividad
         *
         * @param  int  $id
         * @return \Illuminate\Http\Response
         */
        public function edit($id)
        {
            $user      = Auth::user();
            $activity  = Activity::where('id',$id)->firstOrFail();
            $session   = $activity->session;
            $activities =  $session->activities()->where('id','!=',$id)->pluck('name','order')->toArray();
            $activities['first'] = 'Primera actividad';
            $activities['last'] = 'Última actividad';
            //verificar que no exista actividad final
            if($session->module->program->final_evaluation()->first()){
              $types      = [null => "Selecciona una opción","diagnostic"=>'Diagnóstico','evaluation'=>'Evaluación', 'lecture' =>'Lectura', 'video'=> 'Video'];
            }else{
              $types      = [null => "Selecciona una opción","diagnostic"=>'Diagnóstico','evaluation'=>'Evaluación', 'final'=>'Evaluación Final','lecture' =>'Lectura', 'video'=> 'Video'];
            }
            return view('admin.modules.activities.activity-update')->with([
              "user"      => $user,
              "activity" => $activity,
              "activities" => $activities,
              "types"    => $types
            ]);
        }

        /**
         * Actualiza actividad
         *
         * @param  \Illuminate\Http\Request  $request
         * @param  int  $id
         * @return \Illuminate\Http\Response
         */
        public function update(UpdateActivity $request)
        {

            $user   = Auth::user();
            $data   = $request->except(['_token','start','time','link','link_video']);
            $data['slug']    = str_slug($request->name);
            if($request->files && $request->type === 'evaluation'){
                $data['type'] = 'evaluation';
              }
            //actividad sin actualizar
            $last    = Activity::find($request->id);
            if($last->order != $request->order){
              $data['order'] = $last->reorder_add($request,$last->session);
            }
            if($request->type==='final'){
              $data['files']  = 1;
            }
            Activity::where('id',$request->id)->update($data);
            //activity video data
            if($request->type==='video'){
              $video  = ActivityVideo::firstOrCreate(['activity_id'=>$request->id]);
              $video->link = $request->link_video;
              $video->save();
            }

            //webinar - not used
            if($request->type==='webinar'){
              $video  = ActivityVideo::firstOrCreate(['activity_id'=>$request->id]);
              $video->link = $request->link;
              $video->start = $request->start;
              $video->time = $request->time;
              $video->save();
            }
            //actividad cuenta con foro
            if($request->hasforum){
              $forum  = Forum::firstOrCreate(['activity_id'=>$request->id]);
              //agregar numero al final del titulo si se repite nombre del foro en db
              $last_name = $forum->topic;
              $name   = 'Foro de actividad: '.$request->name;
              if($name != $last_name){
                $unique = Forum::select('topic')->where('topic',$name)->distinct()->get();
                if($unique->count()>0){
                  $matches = array();
                  if (preg_match('#(\d+)$#', $request->name, $matches)) {
                    $number = $matches[1]+1;
                    $name   = $name.' '.$number;
                    $forum->topic = $name;
                    $forum->slug  = str_slug($name);
                  }else{
                    $number = 2;
                    $name   = $name.' '.$number;
                    $forum->topic = $name;
                    $forum->slug  = str_slug($name);
                  }
                }else{
                  $forum->topic = $name;
                  $forum->slug  = str_slug($name);
                }
              }
              $forum->description  = $request->description;
              $forum->activity_id  = $request->id;
              $forum->user_id      = $user->id;
              $forum->session_id   = $last->session->id;
              $forum->module_id    = $last->session->module->id;
              $forum->program_id   = $last->session->module->program->id;
              $forum->type = 'activity';
              $forum->save();
            }else{
              $forum  = Forum::where('activity_id',$request->id)->first();
              if($forum){
                $forum->delete();
              }
            }
            //user log
            $log = Log::firstOrCreate([
              'user_id'     => $user->id,
              'session_id'  => $last->session->id,
              'module_id'   => $last->session->module_id,
              'program_id'  => $last->session->module->program->id,
              'activity_id' => $last->id,
              'type'        => 'update'
            ]);
          //re-direccionamiento dependiendo del tipo de actividad
          if($request->hasfiles && $last->hasfiles != $request->hasfiles){
              //Agregar archivos
              return redirect("dashboard/sesiones/actividades/archivos/agregar/$request->id")->with('success',"Se ha guardado correctamente");
            }elseif($request->type==='evaluation' && !$data["files"]){
              //Agregar evaluacion
              if($last->quizInfo){
                  return redirect("dashboard/sesiones/actividades/evaluacion/agregar/$last->id/2")->with('success',"Se ha guardado correctamente");
              }else{
                  return redirect("dashboard/sesiones/actividades/evaluacion/agregar/$last->id/1")->with('success',"Se ha guardado correctamente");
              }
            }elseif($request->type==='diagnostic' && !$data["files"]){
              //Agregar diagnostico
              if($last->diagnosticInfo){
                  return redirect("dashboard/sesiones/actividades/diagnostico/agregar/$last->id/2")->with('success',"Se ha guardado correctamente");
              }else{
                  return redirect("dashboard/sesiones/actividades/diagnostico/agregar/$last->id/1")->with('success',"Se ha guardado correctamente");
              }
           }else{
             //ver actividad
              return redirect("dashboard/sesiones/actividades/ver/$request->id")->with('success',"Se ha actualizado correctamente");
           }
        }

        /**
         * Elimina actividad
         *
         * @param  int  $id
         * @return \Illuminate\Http\Response
         */
        public function delete($id)
        {
            $user   = Auth::user();
            $activity = Activity::where('id',$id)->firstOrFail();
            $session = $activity->session;
            //eliminar archivos de la actividad
            foreach ($activity->activityFiles as $file) {
              File::delete($file->path."/".$file->identifier);
              $file->delete();
            }
            //eliminar video de la actividad
            if($activity->videos){
              $activity->videos->delete();
            }
            //eliminar examenes de la actividad
            if($activity->quizInfo){
              foreach ($activity->quizInfo->question as $question) {
                if($question->answer){
                  foreach ($question->answer as $answer) {
                    $answer->delete();
                  }
                }
                $question->delete();
              }
              $activity->quizInfo->delete();
            }
            //user log
            $log = Log::firstOrCreate([
              'user_id'     => $user->id,
              'session_id'  => $activity->session->id,
              'module_id'   => $activity->session->module_id,
              'program_id'  => $activity->session->module->program->id,
              'activity_id' => $activity->id,
              'type'        => 'delete: '.str_limit($activity->name, 150)
            ]);
            //eliminar foro
            if($activity->hasforum){
              $forum     = $activity->forum;
              foreach ($forum->forum_messages as $message) {
                $message->delete();
              }
              foreach ($forum->forum_conversations as $message) {
                foreach ($message->messages as $mes) {
                  $mes->delete();
                }
                $message->delete();
              }
              //forum log
              $log = new ForumLog();
              $log->user_id = $user->id;
              $log->type    = 'admin';
              $log->action  = 'delete-forum';
              $log->forum_id = $forum->id;
              $log->save();
              $forum->delete();
            }
            //eliminar diagnostico de la actividad
            if($activity->diagnostic_info){
              foreach ($activity->diagnostic_info->questions as $question) {
                if($question->answers){
                  foreach ($question->answers as $answer) {
                    $answer->delete();
                  }
                }
                $question->delete();
              }
              $activity->diagnostic_info->delete();
            }
            $activity->delete();
            return redirect("dashboard/programas/{$session->module->program->id}/modulos/{$session->module->id}/sesiones/ver/$session->id")->with('success',"Se ha eliminado correctamente");
        }

}
