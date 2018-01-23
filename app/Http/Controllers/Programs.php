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
      $notices = Notice::orderBy('start','asc')->pluck('title','id');
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
}
