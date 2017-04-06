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
            $activity->session_id    = $session->id;
            $activity->save();
            return redirect("dashboard/sesiones/actividades/ver/$activity->id")->with('success',"Se ha guardado correctamente");
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
            return view('admin.modules.activities.activity-view')->with([
              "user"      => $user,
              "activity"    => $activity
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
            Activity::where('id',$request->id)->update($data);
            return redirect("dashboard/sesiones/actividades/ver/$request->id")->with('success',"Se ha actualizado correctamente");
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
