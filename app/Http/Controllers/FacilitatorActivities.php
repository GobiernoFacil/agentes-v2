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


class FacilitatorActivities extends Controller
{
  //Paginación
  public $pageSize = 10;

  /**
  * Lista de actividades de usuario facilitador
  *
  * @return \Illuminate\Http\Response
  */
  public function activities()
  {
    $user 			  = Auth::user();
    return view('facilitator.activities.list_activities')->with([
      "user"      		=> $user,
    ]);
  }
  
  /**
  * Ver actividad asignada a facilitador @ facilitador
  *
  * @return \Illuminate\Http\Response
  */
  public function viewActivity()
  {
    $user 			  = Auth::user();
    return view('facilitator.profile.profile-view')->with([
      "user"      		=> $user,
    ]);
  }
  
 

}
