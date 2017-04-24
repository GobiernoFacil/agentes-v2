<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
// models
use App\Models\Module;
use App\Models\ModuleSession;
class SessionFellow extends Controller
{
    //

    /**
    * Muestra sessión
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    public function view($module_slug,$slug)
    {
      //
      $user    = Auth::user();
      $session  = ModuleSession::where('slug',$slug)->first();
      return view('fellow.modules.sessions.session-view')->with([
        "user"      => $user,
        "session"    => $session
      ]);
    }
}
