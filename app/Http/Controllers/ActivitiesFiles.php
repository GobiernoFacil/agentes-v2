<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
// models
use App\Models\Activity;
use App\Models\ActivitiesFile;
// FormValidators
use App\Http\Requests\SaveActivityFiles;
use App\Http\Requests\UpdateActivityFiles;
class ActivitiesFiles extends Controller
{

  //Paginación
  public $pageSize = 10;
  // En esta carpeta se guardan las imágenes de los usuarios
  const UPLOADS = "archivos/actividades";
    //
    /**
     * Agregar archivo a actividad
     *
     * @return \Illuminate\Http\Response
     */
    public function add($activity_id)
    {
        //
        $user      = Auth::user();
        $activity   = Activity::where('id',$activity_id)->firstOrFail();
        return view('admin.modules.activities.activity-files-add')->with([
          "user"      => $user,
          "activity" => $activity
        ]);
    }

    /**
     * Guarda nueva actividad
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function save(SaveActivityFiles $request)
    {
        //
        $user      = Auth::user();
        $session   = Activity::where('id',$request->activity_id)->firstOrFail();
        $path  = public_path(self::UPLOADS);
        // [ SAVE THE file ]
        if($request->hasFile('file') && $request->file('file')->isValid()){
          $name = uniqid() . '.' . $request->file('file')->getClientOriginalExtension();
          $request->file('file')->move($path, $name);
          $file         = new ActivitiesFile();
          $file->name = $request->name;
          $file->identifier = $name;
          $file->description = $request->description;
          $file->activity_id = $request->activity_id;
          $file->path = $path;
          $file->save();
        }
        return redirect("dashboard/sesiones/actividades/ver/$request->activity_id")->with('success',"Se ha actualizado correctamente");
    }
}
