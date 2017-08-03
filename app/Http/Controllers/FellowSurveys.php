<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\FellowSurvey;
// FormValidators
use App\Http\Requests\SaveSatisfactionSurvey;
class FellowSurveys extends Controller
{
    //

    /**
     * Muestra encuesta satisfaccion
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

    /**
     * guarda encuesta satisfaccion
     *
     * @return \Illuminate\Http\Response
     */
    public function saveSurvey(SaveSatisfactionSurvey $request)
    {

    }
}
