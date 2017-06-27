<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use File;
// models
use App\Models\FellowFile;
use App\Models\Activity;
use App\Models\ModuleSession;
// FormValidators
use App\Http\Requests\SaveFellowFiles;
class FellowFiles extends Controller
{
    //
    // En esta carpeta se guardan las imágenes de los usuarios
    const UPLOADS = "archivos/fellows";
    /**
     * Agregar archivo a actividad
     *
     * @return \Illuminate\Http\Response
     */
    public function add($activity_slug)
    {
        //
        $user      = Auth::user();
        $activity  = Activity::where('slug',$activity_slug)->firstOrFail();
        return view('fellow.modules.sessions.activity-files-add')->with([
          "user"      	=> $user,
          "activity" 	=> $activity,
        ]);
    }

    /**
     * Guarda nuevo archivo
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function save(SaveFellowFiles $request)
    {
        //
        $user      = Auth::user();
        $activity   = Activity::where('slug',$request->activity_slug)->firstOrFail();
        $path  = public_path(self::UPLOADS);
        // [ SAVE THE file ]
        if($request->hasFile('file_e') && $request->file('file_e')->isValid()){
          $name = uniqid() . '.' . $request->file('file_e')->getClientOriginalExtension();
          $request->file('file_e')->move($path, $name);
          $file         = new FellowFile();
          $file->name = $request->file('file_e')->getClientOriginalName();
          $file->activity_id = $activity->id;
          $file->path = $path.'/'.$name;
          $file->user_id = $user->id;
          $file->save();
        }
        return redirect("tablero/aprendizaje/{$activity->session->module->slug}/{$activity->session->slug}/$activity->id")->with('success',"Se ha guardado correctamente");
    }
}
