<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use File;
use App\Models\Notice;
use App\Models\AspirantNotice;
use App\Models\AspirantsFile;
use App\Models\Cv;
//validations
use App\Http\Requests\SaveFiles;
use App\Http\Requests\UpdateAspirantFiles;
use App\Http\Requests\SaveApply1;
class AspirantNotices extends Controller
{
    //
   /**
  * Lista de convocatorias
  *
  * @return \Illuminate\Http\Response
  */
  public function index()
  {
    	$user    = Auth::user();
    	$notices = $user->aspirant($user)->notices;
        return view('aspirant.notices.notices-index')->with([
          "user"      => $user,
          "notices"   => $notices

        ]);
  }

  /** Ver convocatoria
  *
  * @return \Illuminate\Http\Response
  */
  public function view($notice_slug)
  {
    	$user    = Auth::user();
      $today   = date('Y-m-d');
      //valida que exista convocatoria
    	$notice  = Notice::where('slug',$notice_slug)->where('end','>=',$today)->where('public',1)->firstOrfail();
      $aspirant_notice = AspirantNotice::where('aspirant_id',$user->aspirant($user)->id)->firstOrfail();
        return view('aspirant.notices.notices-view')->with([
          "user"      => $user,
          "notice"   => $notice

        ]);
  }


  /**  comienzo del proceso para postularse a la convocatoria
  *
  * @return \Illuminate\Http\Response
  */
  public function apply($notice_slug)
  {
      $user    = Auth::user();
      $today   = date('Y-m-d');
      //valida que exista convocatoria
      $notice  = Notice::where('slug',$notice_slug)->where('end','>=',$today)->where('public',1)->firstOrfail();
      //valida que exista el aspirante en la convocatoria
      $aspirant_notice = AspirantNotice::where('aspirant_id',$user->aspirant($user)->id)->firstOrfail();
      //instrucciones y primer requisito "exposición de motivos"
      return view('aspirant.notices.notices-apply')->with([
          "user"      => $user,
          "notice"   => $notice

        ]);
  }

  /**  guarda primer paso de proceso
  *
  * @return \Illuminate\Http\Response
  */
  public function applyMotives(SaveApply1 $request)
  {
      $user    = Auth::user();
      $today   = date('Y-m-d');
      //valida que exista convocatoria
      $notice  = Notice::where('slug',$request->notice_slug)->where('end','>=',$today)->where('public',1)->firstOrfail();
      //valida que exista el aspirante en la convocatoria
      $aspirant_notice = AspirantNotice::where('aspirant_id',$user->aspirant($user)->id)->firstOrfail();
      //instrucciones y primer requisito "exposición de motivos"
      $aspirantFile     = AspirantsFile::firstOrCreate([
        'aspirant_id'=>$user->aspirant($user)->id,
        'notice_id'=>$notice->id,
        'user_id'=>$user->id
      ]);
      $aspirantFile->motives = $request->motives;
      $aspirantFile->save();
      return redirect("tablero-aspirante/convocatorias/$notice->slug/aplicar/agregar-perfil-curricular");


  }


  /**  agregar perfil curricular
  *
  * @return \Illuminate\Http\Response
  */
  public function applyCv($notice_slug)
  {
      $user    = Auth::user();
      $today   = date('Y-m-d');
      //valida que exista convocatoria
      $notice  = Notice::where('slug',$notice_slug)->where('end','>=',$today)->where('public',1)->firstOrfail();
      //valida que exista el aspirante en la convocatoria
      $aspirant_notice = AspirantNotice::where('aspirant_id',$user->aspirant($user)->id)->firstOrfail();
      //instrucciones y primer requisito "exposición de motivos"
      $cv      = Cv::firstOrCreate(['aspirant_id'=>$user->aspirant($user)->id]);
      return view('aspirant.notices.notices-apply-cv')->with([
          "user"      => $user,
          "notice"    => $notice,
          "cv"        => $cv

        ]);
  }

        /** Ver archivos de convocatoria
      *
      * @return \Illuminate\Http\Response
      */
      public function viewFiles($notice_slug)
      {
          $user   = Auth::user();
          $today   = date('Y-m-d');
          //valida que exista convocatoria
          $notice = Notice::where('slug',$notice_slug)->where('end','>=',$today)->where('public',1)->firstOrfail();
          //valida que exista el aspirante en la convocatoria
          $aspirant_notice = AspirantNotice::where('aspirant_id',$user->aspirant($user)->id)->firstOrfail();
          $files  = AspirantsFile::where('user_id',$user->id)->where('notice_id',$notice->id)->first();
            return view('aspirant.notices.files-view')->with([
              "user"      => $user,
              "notice"    => $notice,
              "files"     => $files

            ]);
      }

         /** agregar archivos a convocatoria
      *
      * @return \Illuminate\Http\Response
      */
      public function addFiles($notice_slug)
      {
          $user   = Auth::user();
          $today   = date('Y-m-d');
          $notice = Notice::where('slug',$notice_slug)->where('end','>=',$today)->where('public',1)->firstOrfail();
          $aspirant_notice = AspirantNotice::where('aspirant_id',$user->aspirant($user)->id)->firstOrfail();
            return view('aspirant.notices.files-add')->with([
              "user"      => $user,
              "notice"    => $notice,

            ]);
      }

        /** actualizar archivos a convocatoria
      *
      * @return \Illuminate\Http\Response
      */
      public function editFiles($notice_slug)
      {
         $user   = Auth::user();
         $today   = date('Y-m-d');
         $notice = Notice::where('slug',$notice_slug)->where('end','>=',$today)->where('public',1)->firstOrfail();
         $aspirant_notice = AspirantNotice::where('aspirant_id',$user->aspirant($user)->id)->firstOrfail();
         $files  = AspirantsFile::where('user_id',$user->id)->where('notice_id',$notice->id)->first();
           return view('aspirant.notices.files-update')->with([
             "user"      => $user,
             "notice"    => $notice,
             "files"     => $files

           ]);
      }

      /** guardar archivos actualizados a convocatoria
    *
    * @return \Illuminate\Http\Response
    */
    public function updateFiles(UpdateAspirantFiles $request)
    {
      $user   = Auth::user();
      $today   = date('Y-m-d');
      $notice = Notice::where('slug',$request->notice_slug)->where('end','>=',$today)->where('public',1)->firstOrfail();
      $aspirant_notice = AspirantNotice::where('aspirant_id',$user->aspirant($user)->id)->firstOrfail();
      $aspirantFile    = AspirantsFile::where('aspirant_id',$user->aspirant($user)->id)->where('notice_id',$notice->id)->where('user_id',$user->id)->firstOrfail();
      if($request->file('cv')){
         if($request->file('cv')->isValid()){
              $name = uniqid() . "." . $request->file("cv")->guessExtension();
              $path = "/files/";
              $request->file('cv')->move(public_path() . $path, $name);
              $aspirantFile->cv = $name;
          }
      }
      if($request->file('essay')){
          if($request->file('essay')->isValid()){
              $name = uniqid() . "." . $request->file("essay")->guessExtension();
              $path = "/files/";
              $request->file('essay')->move(public_path() . $path, $name);
              File::delete(public_path().$path.$aspirantFile->essay);
              $aspirantFile->essay = $name;
          }
      }
      if($request->file('letter')){
          if($request->file('letter')->isValid()){
              $name = uniqid() . "." . $request->file("letter")->guessExtension();
              $path = "/files/";
              $request->file('letter')->move(public_path() . $path, $name);
              File::delete(public_path().$path.$aspirantFile->letter);
              $aspirantFile->letter = $name;
          }
      }
      if($request->file('proof')){
          if($request->file('proof')->isValid()){
              $name = uniqid() . "." . $request->file("proof")->guessExtension();
              $path = "/files/";
              $request->file('proof')->move(public_path() . $path, $name);
              File::delete(public_path().$path.$aspirantFile->proof);
              $aspirantFile->proof = $name;
          }
      }
      if($request->file('privacy')){
          if($request->file('privacy')->isValid()){
              $name = uniqid() . "." . $request->file("privacy")->guessExtension();
              $path = "/files/";
              $request->file('privacy')->move(public_path() . $path, $name);
              File::delete(public_path().$path.$aspirantFile->privacy);
              $aspirantFile->privacy = $name;
          }
      }
      $aspirantFile->video = $request->video;
      $aspirantFile->save();
      return redirect("tablero-aspirante/convocatorias/$notice->slug/ver-archivos")->with('success',"Tus archivos han sido actualizados");
    }



      /** guardar archivos a convocatoria
    *
    * @return \Illuminate\Http\Response
    */
    public function saveFiles(SaveFiles $request)
    {
       $user   = Auth::user();
       $today   = date('Y-m-d');
       $notice = Notice::where('slug',$request->notice_slug)->where('end','>=',$today)->where('public',1)->firstOrfail();
       $aspirant_notice = AspirantNotice::where('aspirant_id',$user->aspirant($user)->id)->firstOrfail();
       $aspirantFile     = AspirantsFile::firstOrCreate([
         'aspirant_id'=>$user->aspirant($user)->id,
         'notice_id'=>$notice->id,
         'user_id'=>$user->id
       ]);

      if($request->file('cv')->isValid()){
           $name = uniqid() . "." . $request->file("cv")->guessExtension();
           $path = "/files/";
           $request->file('cv')->move(public_path() . $path, $name);
           $aspirantFile->cv = $name;
       }
       if($request->file('essay')->isValid()){
           $name = uniqid() . "." . $request->file("essay")->guessExtension();
           $path = "/files/";
           $request->file('essay')->move(public_path() . $path, $name);
           $aspirantFile->essay = $name;
       }
       if($request->file('letter')->isValid()){
           $name = uniqid() . "." . $request->file("letter")->guessExtension();
           $path = "/files/";
           $request->file('letter')->move(public_path() . $path, $name);
           $aspirantFile->letter = $name;
       }
       if($request->file('proof')->isValid()){
           $name = uniqid() . "." . $request->file("proof")->guessExtension();
           $path = "/files/";
           $request->file('proof')->move(public_path() . $path, $name);
           $aspirantFile->proof = $name;
       }
       if($request->file('privacy')->isValid()){
           $name = uniqid() . "." . $request->file("privacy")->guessExtension();
           $path = "/files/";
           $request->file('privacy')->move(public_path() . $path, $name);
           $aspirantFile->privacy = $name;
       }
       $aspirantFile->video = $request->video;
       $aspirantFile->save();
       return redirect("tablero-aspirante/convocatorias/$notice->slug/ver-archivos")->with('success',"Tu registro se ha finalizado con éxito");
    }


        public function download($name,$type){
          $user = Auth::user();
          $file = public_path(). "/files/".$name;
          $ext  = substr(strrchr($file,'.'),1);
          $mime = mime_content_type ($file);
          $headers = array(
            'Content-Type: '.$mime,
          );
          if($type =='CV'){
            $filename = 'CV'.".".$ext;
          }else if($type =='carta'){
              $filename = 'carta'.".".$ext;
          }else if($type =='comprobante'){
              $filename = 'comprobante'.".".$ext;
          }else if($type =='privacidad'){
              $filename = 'privacidad'.".".$ext;
          }else{
            $filename = 'Ensayo'.".".$ext;
          }
          return response()->download($file, $filename, $headers);
        }


        public function addLanguage(Request $request){
          $user = Auth::user();
          $cv   = $user->aspirant($user)->cv;
          $language = $cv->languages()->firstOrCreate([
            'name'  => $request->name,
            'level' => $request->level
          ]);

          return response()->json($language);
        }

        public function removeLanguage($id){
          $user = Auth::user();
          $lang = $user->aspirant($user)->cv->languages()->find($id);
          $r    = $lang->delete();

          return response()->json($r);
        }

        public function addSoftware(Request $request){
          $user     = Auth::user();
          $cv       = $user->aspirant($user)->cv;
          $software = $cv->softwares()->firstOrCreate([
            'name'  => $request->name,
            'level' => $request->level
          ]);

          return response()->json($software);
        }

        public function removeSoftware($id){
          $user     = Auth::user();
          $software = $user->aspirant($user)->cv->softwares()->find($id);
          $r        = $software->delete();

          return response()->json($r);
        }

        public function addExperience(Request $request){
          $user     = Auth::user();
          $cv       = $user->aspirant($user)->cv;
          $experience = $cv->experiences()->firstOrCreate([
            'name'  => $request->name,
            'company' => $request->company,
            'sector' => $request->sector,
            'from' => $request->from,
            'to' => $request->to,
            'city' => $request->city,
            'state' => $request->state,
            'description' => $request->description

          ]);

          return response()->json($experience);
        }

        public function removeExperience($id){
          $user     = Auth::user();
          $experience = $user->aspirant($user)->cv->experiences()->find($id);
          $r        = $experience->delete();

          return response()->json($r);
        }

        public function addStudy(Request $request){
          $user  = Auth::user();
          $cv    = $user->aspirant($user)->cv;
          $study = $cv->academic_trainings()->firstOrCreate([
            'name'        => $request->name,
            'institution' => $request->institution,
            'from'        => $request->from,
            'to'          => $request->to,
            'city'        => $request->city,
          ]);

          return response()->json($study);
        }

        public function removeStudy($id){
          $user  = Auth::user();
          $study = $user->aspirant($user)->cv->academic_trainings()->find($id);
          $r     = $study->delete();

          return response()->json($r);
        }

}
