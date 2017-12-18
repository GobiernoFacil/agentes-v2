<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\Notice;
class AspirantNotice extends Controller
{
    //
    /**
  * edita perfil del usuario aspirante 
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
}
