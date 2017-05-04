<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Hash;
use File;

use Mail;
// models
use App\User;
use App\Models\ModuleSession;
use App\Models\FacilitatorData;
use App\Models\Image;


class FacilitatorMessages extends Controller
{
  //Paginación
  public $pageSize = 10;

  /**
  * Lista de mensajes de usuario facilitador
  *
  * @return \Illuminate\Http\Response
  */
  public function messages()
  {
    $user 			  = Auth::user();
    return view('facilitator.messages.messages-list')->with([
      "user"      		=> $user,
    ]);
  }
  
  /**
  * Ver mensaje a facilitador @ facilitador
  *
  * @return \Illuminate\Http\Response
  */
  public function viewMessage()
  {
    $user 			  = Auth::user();
    return view('facilitator.messages.message-view')->with([
      "user"      		=> $user,
    ]);
  }
  
 

}
