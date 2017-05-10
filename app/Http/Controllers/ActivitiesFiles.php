<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use File;
// models
use App\Models\Activity;
use App\Models\ActivitiesFile;
use App\Models\ModuleSession;
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
     * ver archivo en actividad
     *
     * @return \Illuminate\Http\Response
     */
    public function view($id)
    {
        //
        $user      = Auth::user();
        $file   = ActivitiesFile::where('id',$id)->firstOrFail();
        return view('admin.modules.activities.activity-file-view')->with([
          "user"      => $user,
          "file" => $file
        ]);
    }
    /**
     * Agregar archivo a actividad
     *
     * @return \Illuminate\Http\Response
     */
    public function add($activity_id)
    {
        //
        $user      = Auth::user();
        $activity  = Activity::where('id',$activity_id)->firstOrFail();
        $session   = ModuleSession::where('id',$activity->session_id)->firstOrFail();
        return view('admin.modules.activities.activity-files-add')->with([
          "user"      	=> $user,
          "activity" 	=> $activity,
          "session"		=> $session
        ]);
    }

    /**
     * Guarda nuevo archivo en  actividad
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function save(SaveActivityFiles $request)
    {
        //
        $user      = Auth::user();
        $activity   = Activity::where('id',$request->activity_id)->firstOrFail();
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
        if($activity->type==='evaluation'){
          //cargar evaluacion
          return redirect("dashboard/sesiones/actividades/evaluacion/agregar/$request->activity_id")->with('success',"Se ha guardado correctamente");
        }else{
          return redirect("dashboard/sesiones/actividades/ver/$request->activity_id")->with('success',"Se ha actualizado correctamente");
        }
    }

    /**
     * actualizar archivo de actividad
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($file_id)
    {
        //
        $user      = Auth::user();
        $file   = ActivitiesFile::where('id',$file_id)->firstOrFail();
        return view('admin.modules.activities.activity-files-update')->with([
          "user"      => $user,
          "file" => $file
        ]);
    }

    /**
     * Actualiza archivo
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateActivityFiles $request)
    {
        //
        $user      = Auth::user();
        $file   = ActivitiesFile::where('id',$request->file_id)->firstOrFail();
        $path  = public_path(self::UPLOADS);
        // [ SAVE THE file ]
        if($request->hasFile('file') && $request->file('file')->isValid()){
          $name = uniqid() . '.' . $request->file('file')->getClientOriginalExtension();
          $request->file('file')->move($path, $name);
          //delete older file
          File::delete($file->path."/".$file->identifier);
          $file->name = $request->name;
          $file->identifier = $name;
          $file->description = $request->description;
          $file->path = $path;
          $file->save();
        }
        return redirect("dashboard/sesiones/actividades/ver/{$file->activity->id}")->with('success',"Se ha actualizado correctamente");
    }

    /**
    *descargar archivo
    *
    * @return \Illuminate\Http\Response
    */
    public function download(Request $request){
      $user = Auth::user();
      $data = ActivitiesFile::find($request->id);
      $file = $data->path.'/'.$data->identifier;
      $ext  = substr(strrchr($data->identifier,'.'),1);
      $mime = mime_content_type ($file);
      $headers = array(
        'Content-Type: '.$mime,
      );

      $filename = $data->name.".".$ext;
      return response()->download($file, $filename, $headers);
    }
}
