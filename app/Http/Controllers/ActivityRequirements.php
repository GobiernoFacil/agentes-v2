<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
// models
use App\Models\Activity;
use App\Models\ActivityRequirement;
use App\Models\ModuleSession;
// FormValidators
use App\Http\Requests\SaveActivityRequirement;
use App\Http\Requests\UpdateActivityRequirement;
class ActivityRequirements extends Controller
{














  /*
    *
    *
    *
      CONTROLLER NOT USED
    *
    *
    *
    *
  */

















  //Paginación
  public $pageSize = 10;

        /**
         * Agregar requerimiento
         *
         * @return \Illuminate\Http\Response
         */
        public function add($activity_id)
        {
            //
            $user      = Auth::user();
            $activity   = Activity::where('id',$activity_id)->firstOrFail();
            $session   = ModuleSession::where('id',$activity->session_id)->firstOrFail();
            return view('admin.modules.activities.activity-requirement-add')->with([
              "user"      	=> $user,
              "activity" 	=> $activity,
              "session" 	=> $session
            ]);
        }

        /**
         * Guarda nuevo requerimiento
         *
         * @param  \Illuminate\Http\Request  $request
         * @return \Illuminate\Http\Response
         */
        public function save(SaveActivityRequirement $request)
        {
            //
            $user      = Auth::user();
            $activity   = Activity::where('id',$request->activity_id)->firstOrFail();
            $activityR  = new ActivityRequirement($request->except('_token'));
            $activityR->activity_id    = $activity->id;
            $activityR->save();
            return redirect("dashboard/sesiones/actividades/ver/$activity->id")->with('success',"Se ha guardado correctamente");
        }

        /**
         * Muestra requerimiento
         *
         * @param  int  $id
         * @return \Illuminate\Http\Response
         */
        public function view($id)
        {
            //
            $user    = Auth::user();
            $activityR = ActivityRequirement::find($id);
            return view('admin.modules.activities.activity-requirement-view')->with([
              "user"      => $user,
              "activityR"    => $activityR
            ]);
        }

        /**
         * Muestra contenido para actualizar un requerimiento
         *
         * @param  int  $id
         * @return \Illuminate\Http\Response
         */
        public function edit($id)
        {
            //
            $user      = Auth::user();
            $activityR  = ActivityRequirement::where('id',$id)->firstOrFail();
            $activity   = Activity::where('id',$activityR->activity_id)->firstOrFail();
            $session   = ModuleSession::where('id',$activity->session_id)->firstOrFail();
            return view('admin.modules.activities.activity-requirement-update')->with([
              "user"      => $user,
              "activity"  => $activity,
              "activityR" => $activityR,
              "session"	  => $session,
            ]);
        }

        /**
         * Actualiza requerimiento
         *
         * @param  \Illuminate\Http\Request  $request
         * @param  int  $id
         * @return \Illuminate\Http\Response
         */
        public function update(UpdateActivityRequirement $request)
        {
            //
            $data   = $request->except('_token');
            $activityR  = ActivityRequirement::where('id',$request->id)->firstOrFail();
            $activity   = Activity::where('id',$activityR->activity_id)->firstOrFail();
            ActivityRequirement::where('id',$request->id)->update($data);
            return redirect("dashboard/sesiones/actividades/ver/$activity->id")->with('success',"Se ha actualizado correctamente");
        }

        /**
         * Deshabilita requerimiento
         *
         * @param  int  $id
         * @return \Illuminate\Http\Response
         */
        public function delete($id)
        {
            //
            $requirement  = ActivityRequirement::where('id',$id)->firstOrFail();
            $ac_id  = $requirement->activity_id;
            $requirement->delete();
            return redirect("dashboard/sesiones/actividades/ver/$ac_id")->with('success',"Se ha eliminado correctamente");

        }
}
