<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
// models
use App\Models\Activity;
use App\Models\ModuleSession;
// FormValidators
use App\Http\Requests\SaveActivity;
use App\Http\Requests\UpdateActivity;
class Activities extends Controller
{
  //Paginación
  public $pageSize = 10;

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
            $activity  = new Activity($request->except('_token'));
            if($request->files ==='Sí'){
              $activity->type = 'files';
            }
            $activity->slug          = str_slug($request->name);
            $activity->session_id    = $session->id;
            $activity->save();
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
            $data   = $request->except('_token');
            $data['slug']    = str_slug($request->name);
            if($request->files ==='Sí'){
              $data['type'] = 'files';
            }
            $last    = Activity::find($request->id);
            Activity::where('id',$request->id)->update($data);
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
        }
}
