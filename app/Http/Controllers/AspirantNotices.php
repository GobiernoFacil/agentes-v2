<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\Notice;
use App\Models\AspirantNotice;
use App\Models\AspirantsFile;
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
    	$notice  = Notice::where('slug',$notice_slug)->where('public',1)->firstOrfail();
      $aspirant_notice = AspirantNotice::where('aspirant_id',$user->aspiran($user)->id)->firstOrfail();  
        return view('aspirant.notices.notices-view')->with([
          "user"      => $user,
          "notice"   => $notice

        ]);
  }

    /** Ver archivos de convocatoria
  *
  * @return \Illuminate\Http\Response
  */
  public function viewFiles($notice_slug)
  {
      $user   = Auth::user();
      $notice = Notice::where('slug',$notice_slug)->where('public',1)->firstOrfail();
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
      $notice = Notice::where('slug',$notice_slug)->where('public',1)->firstOrfail();
      $aspirant_notice = AspirantNotice::where('aspirant_id',$user->aspirant($user)->id)->firstOrfail();
        return view('aspirant.notices.files-add')->with([
          "user"      => $user,
          "notice"    => $notice,

        ]);
  }


}
