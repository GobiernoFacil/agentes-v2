<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\Notice;
use App\Models\NoticeFile;
//Request validations
use App\Http\Requests\SaveAdminNotice;
use App\Http\Requests\SaveAdminNoticeFiles;
class AdminNotice extends Controller
{
    //
    /**
     * Muestra lista de convocatorias
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $user    = Auth::user();
        $notices = Notice::orderBy('start','desc')->get();
        return view('admin.notices.list-view')->with([
          'user'    => $user,
          'notices' => $notices
        ]);
    }

    /**
     * Muestra formulario para agregar convocatoria
     *
     * @return \Illuminate\Http\Response
     */
    public function add()
    {
        //
        $user    = Auth::user();
        return view('admin.notices.notice-add')->with([
          'user'    => $user,
        ]);
    }

    /**
     * Guarda  convocatoria
     *
     * @return \Illuminate\Http\Response
     */
    public function save(SaveAdminNotice $request)
    {
      $user    = Auth::user();
      $notice  = new Notice($request->except(['_token','hasfiles']));
      $notice->user_id = $user->id;
      $notice->save();
      //convocatoria contiene archivos para descargar
      if($request->hasfiles){
        return redirect('dashboard/convocatorias/agregar-archivos/'.$notice->id);
      }else{
        return redirect('dashboard/convocatorias/ver/'.$notice->id)->with(['message'=>'Se ha guardado correctamente']);
      }

    }

    /**
     * Muestra formulario para agregar archivos a convocatoria
     *
     * @return \Illuminate\Http\Response
     */
    public function addFiles($id)
    {
        //
        $user    = Auth::user();
        $notice  = Notice::where('id',$id)->firstOrFail();
        return view('admin.notices.notice-add-file')->with([
          'user'    => $user,
          'notice'  => $notice
        ]);

    }


        /**
         * Guarda  convocatoria
         *
         * @return \Illuminate\Http\Response
         */
        public function saveFiles(SaveAdminNoticeFiles $request)
        {
          $user    = Auth::user();
          if($files=$request->file('filesData')){
              $path = public_path().'/archivos/notices';
              foreach($files as $file){
                        $name=$file->getClientOriginalName();
                        $identifier = uniqid() . '.' . $file->getClientOriginalExtension();
                        $file->move($path,$identifier);
                        $fullpath = $path.'/'.$identifier;
                        $filesData = NoticeFile::firstOrCreate(['notice_id'=>$request->notice_id,'name'=>$name,'path'=>$fullpath,'comments'=>$request->comments]);
              }
            }

            return redirect('dashboard/convocatorias/ver/'.$request->notice_id)->with(['message'=>'Se ha guardado correctamente']);

        }

        /**
         * Muestra formulario para agregar archivos a convocatoria
         *
         * @return \Illuminate\Http\Response
         */
        public function view($id)
        {
            //
            $user    = Auth::user();
            $notice  = Notice::where('id',$id)->firstOrFail();
            return view('admin.notices.notice-view')->with([
              'user'    => $user,
              'notice'  => $notice
            ]);

        }

        /**
        *descargar archivo
        *
        * @return \Illuminate\Http\Response
        */
        public function download(Request $request){
          $user = Auth::user();
          $data = NoticeFile::find($request->file_id);
          $file = $data->path;
          $ext  = substr(strrchr($data->name,'.'),1);
          $mime = mime_content_type ($file);
          $headers = array(
            'Content-Type: '.$mime,
          );

          $filename = $data->name.".".$ext;
          return response()->download($file, $filename, $headers);
        }

}
