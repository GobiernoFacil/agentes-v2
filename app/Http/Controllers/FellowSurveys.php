<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class FellowSurveys extends Controller
{
    //

    /**
     * Muestra encuesta general
     *
     * @return \Illuminate\Http\Response
     */
    public function addSurvey()
    {
      $user     = Auth::user();
      return view('fellow.surveys.satisfaction-survey-1')->with([
        'user'=>$user,
        'evaluation'=>$user,
        'aspirant' =>$user
      ]);

    }
}
