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
     * ver agregar archivo a actividad
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
     * ver agregar un archivo a actividad
     *
     * @return \Illuminate\Http\Response
     */
    public function addSingle($activity_id)
    {
        //
        $user      = Auth::user();
        $activity  = Activity::where('id',$activity_id)->firstOrFail();
        $session   = ModuleSession::where('id',$activity->session_id)->firstOrFail();
        return view('admin.modules.activities.activity-files-add-single')->with([
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
        if($activity->type==='evaluation' && !$activity->files){
          //cargar evaluacion
        //  return redirect("dashboard/sesiones/actividades/evaluacion/agregar/$request->activity_id/1")->with('success',"Se ha guardado correctamente");
        if($activity->quizInfo){
            return redirect("dashboard/sesiones/actividades/evaluacion/agregar/$activity->id/2")->with('success',"Se ha guardado correctamente");
        }else{

            return redirect("dashboard/sesiones/actividades/evaluacion/agregar/$activity->id/1")->with('success',"Se ha guardado correctamente");
        }
        }else{
          return redirect("dashboard/sesiones/actividades/ver/$request->activity_id")->with('success',"Se ha actualizado correctamente");
        }
    }

    /**
     * Guarda nuevo archivo en  actividad
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function saveSingle(SaveActivityFiles $request)
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

        return redirect("dashboard/sesiones/actividades/ver/$request->activity_id")->with('success',"Se ha actualizado correctamente");
    }

    /**
     * actualizar archivo de actividad
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($file_id)
    {
        $user      = Auth::user();
        $file      = ActivitiesFile::where('id',$file_id)->firstOrFail();
        $activity  = Activity::where('id',$file->activity_id)->firstOrFail();
        $session   = ModuleSession::where('id',$activity->session_id)->firstOrFail();
        return view('admin.modules.activities.activity-files-update')->with([
          "user"    => $user,
          "file" 	=> $file,
          "activity"=> $activity,
          "session" => $session
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
      $fileData = pathinfo($file);
      $headers = array(
        'Content-Type: '.$fileData['extension'],
      );
      $filename = $data->name.".".$fileData['extension'];
      return response()->download($fileData['dirname'].'/'.$fileData['basename'], $filename, $headers);
    }

    /**
    *descargar archivo
    *
    * @return \Illuminate\Http\Response
    */
    public function watchPdf($id){
      $user = Auth::user();
      $data = ActivitiesFile::find($id);
      $file = $data->path.'/'.$data->identifier;
      $fileData = pathinfo($file);
      $headers = array(
        'Content-Type: '.$fileData['extension'],
      );
      $filename = $data->name.".".$fileData['extension'];
      return response()->file($fileData['dirname'].'/'.$fileData['basename'], $headers);
    }

    /**
    *descargar archivo
    *
    * @return \Illuminate\Http\Response
    */
    public function watchPdfFellow($program_slug,$id){
      $user = Auth::user();
      $data = ActivitiesFile::find($id);
      $file = $data->path.'/'.$data->identifier;
      $fileData = pathinfo($file);
      $headers = array(
        'Content-Type: '.$fileData['extension'],
      );
      $filename = $data->name.".".$fileData['extension'];
      return response()->file($fileData['dirname'].'/'.$fileData['basename'], $headers);
    }

    /**
     * elimina archivo
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        //
        $file  = ActivitiesFile::where('id',$id)->firstOrFail();
        $ac_id  = $file->activity_id;
        File::delete($file->path."/".$file->identifier);
        $file->delete();
        return redirect("dashboard/sesiones/actividades/ver/$ac_id")->with('success',"Se ha eliminado correctamente");

    }
}
