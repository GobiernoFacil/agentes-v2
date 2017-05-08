<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use File;
// models
use App\Models\Activity;
use App\Models\ActivityVideo;
use App\Models\ModuleSession;
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
         * Búsqueda de actividad
         *
         * @return \Illuminate\Http\Response
         */
        public function search()
        {
            //
        }

        /**
         * Muestra lista de actividades
         *
         * @return \Illuminate\Http\Response
         */
        public function index()
        {
            //
        }

        /**
         * Agregar actividad
         *
         * @return \Illuminate\Http\Response
         */
        public function add($session_id)
        {
            //
            $user      = Auth::user();
            $session   = ModuleSession::where('id',$session_id)->firstOrFail();
            return view('admin.modules.activities.activity-add')->with([
              "user"      => $user,
              "session" => $session
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
            $session   = ModuleSession::where('id',$request->session_id)->firstOrFail();
            $activity  = new Activity($request->except(['_token','time','start','end','link']));
            if($request->files ==='Sí'){
              $activity->type = 'files';
            }
            $activity->slug          = str_slug($request->name);
            $activity->session_id    = $session->id;
            $activity->save();
            //activity video data
            if($activity->type==='video'){
              $video  = new ActivityVideo($request->only(['time','start','end','link']));
              $video->activity_id = $activity->id;
              $video->save();
            }
            if($activity->hasfiles==='Sí'){
              //Agregar archivos
              return redirect("dashboard/sesiones/actividades/archivos/agregar/$activity->id")->with('success',"Se ha guardado correctamente");
            }elseif($activity->type==='evaluation'){
              //Agregar evaluacion
              return redirect("dashboard/sesiones/actividades/evaluacion/agregar/$activity->id")->with('success',"Se ha guardado correctamente");
           }else{
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
            //
            $user    = Auth::user();
            $activity = activity::find($id);
			      $session = ModuleSession::where('id',$activity->session_id)->firstOrFail();
            return view('admin.modules.activities.activity-view')->with([
              "user"      	=> $user,
              "activity"    => $activity,
              "session"		=> $session
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
            //
            $user      = Auth::user();
            $activity   = Activity::where('id',$id)->firstOrFail();
            return view('admin.modules.activities.activity-update')->with([
              "user"      => $user,
              "activity" => $activity
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
            //
            $data   = $request->except(['_token','start','end','time','link']);
            $data['slug']    = str_slug($request->name);
            if($request->files ==='Sí'){
              $data['type'] = 'files';
            }
            $last    = Activity::find($request->id);
            Activity::where('id',$request->id)->update($data);
            //activity video data
            if($request->type==='video'){
              $video  = ActivityVideo::firstOrCreate(['activity_id'=>$request->id]);
              $video->start = $request->start;
              $video->end = $request->end;
              $video->link = $request->link;
              $video->time = $request->time;
              $video->save();
            }


            if($request->hasfiles==='Sí' && $last->hasfiles!=$request->hasfiles){
              //Agregar archivos
              return redirect("dashboard/sesiones/actividades/archivos/agregar/$request->id")->with('success',"Se ha guardado correctamente");
            }elseif($data['type']==='evaluation' && $last->type!=$data['type']){
              //Agregar evaluacion
              return redirect("dashboard/sesiones/actividades/evaluacion/agregar/$request->id")->with('success',"Se ha guardado correctamente");
           }else{
              return redirect("dashboard/sesiones/actividades/ver/$request->id")->with('success',"Se ha actualizado correctamente");
           }
        }

        /**
         * Deshabilita actividad
         *
         * @param  int  $id
         * @return \Illuminate\Http\Response
         */
        public function delete($id)
        {
            //
            $activity = Activity::where('id',$id)->firstOrFail();
            $session_id = $activity->session_id;
            foreach ($activity->activityFiles as $file) {
              File::delete($file->path."/".$file->identifier);
              $file->delete();
            }

            foreach ($activity->activityRequirements as $requirement) {
              $requirement->delete();
            }
            if($activity->videos){
              $activity->videos->delete();
            }
            $activity->delete();
            return redirect("dashboard/sesiones/ver/$session_id")->with('success',"Se ha eliminado correctamente");
        }
}
