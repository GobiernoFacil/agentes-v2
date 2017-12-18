<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\Notice;
class AspirantNotice extends Controller
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
    	$today   =  date('Y-m-d');
    	$notices = Notice::where('start','<=',$today)->where('end','>=',$today)->where('public',1)->get();
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
    	$notice = Notice::where('slug',$notice_slug)->where('public',1)->firstOrfail();
        return view('aspirant.notices.notices-view')->with([
          "user"      => $user,
          "notice"   => $notice

        ]);
  }


}
