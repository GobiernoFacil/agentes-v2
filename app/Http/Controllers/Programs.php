<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
// models
use App\Models\Program;
use App\Models\Notice;
use App\Models\NoticeProgram;
use App\User;
// FormValidators
use App\Http\Requests\SaveProgram;
use App\Http\Requests\UpdateProgram;
class Programs extends Controller
{
    //Paginación
    public $pageSize = 10;

    /**
    * Muestra lista de programas
    *
    * @return \Illuminate\Http\Response
    */
    public function index()
    {
      //
      $user 		  = Auth::user();
      $programs 	= Program::orderBy('start','asc')->paginate($this->pageSize);
      return view('admin.programs.programs-list')->with([
        'user' 	    => $user,
        'programs'  => $programs,
      ]);

    }

    /**
    * Agregar programa
    *
    * @return \Illuminate\Http\Response
    */
    public function add()
    {
      $user    = Auth::user();
      $notices_ids = NoticeProgram::pluck('notice_id');
      $notices = Notice::orderBy('start','asc')->whereNotIn('id',$notices_ids->toArray())->pluck('title','id');
      $notices[0] = "Selecciona una opción";
      return view('admin.programs.program-add')->with([
        "user"      => $user,
        "notices"   => $notices
       ]);
    }

    /**
    * Guarda un programa
    *
    * @param  \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
    */
    public function save(SaveProgram $request)
    {
      //
      $user   = Auth::user();
      $data   = $request->except('_token');
      $data['slug']    = str_slug($request->title);
      $program = new Program($data);
      $program->save();
      $noticeProgram = NoticeProgram::firstOrCreate(['notice_id'=>$request->notice_id,'program_id'=>$program->id]);
      return redirect("dashboard/programas/ver/$program->id")->with('success',"Se ha guardado correctamente");
    }

    /**
    * Muestra programa
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    public function view($id)
    {
      //
      $user     = Auth::user();
      $program  = Program::where('id',$id)->firstOrFail();
      return view('admin.programs.program-view')->with([
        "user"      => $user,
        "program"    => $program
      ]);
    }

    /**
    * Muestra contenido para actualizar un programa
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    public function edit($id)
    {
      //
      $user = Auth::user();
      $program     = Program::where('id',$id)->firstOrFail();
      $notices_ids = NoticeProgram::pluck('notice_id');
      $notices = Notice::orderBy('start','asc')->whereNotIn('id',$notices_ids->toArray())->pluck('title','id');
      $notices[$program->notice_id] = $program->notice->notice_data->title;
      $notices[0] = "Selecciona una opción";
      return view('admin.programs.program-update')->with([
        'user' => $user,
        'program' =>$program,
        'notices' => $notices
      ]);
    }

    /**
    * Actualiza programa
    *
    * @param  \Illuminate\Http\Request  $request
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    public function update(UpdateProgram $request)
    {
      //
      $data   = $request->except('_token');
      $data['slug']    = str_slug($request->title);
      Program::where('id',$request->id)->update($data);
      return redirect("dashboard/programas/ver/$request->id")->with('success',"Se ha actualizado correctamente");
    }

    /**
    * Deshabilita programa
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    public function delete($id)
    {
      //
      $program     = Program::where('id',$id)->firstOrFail();
      foreach($program->modules as $module){
        $module->title;
      }
      $program->notice;
    }
}
