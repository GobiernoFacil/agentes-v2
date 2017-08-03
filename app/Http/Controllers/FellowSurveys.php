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
    //  $survey   = FellowSurvey::where('user_id',$user->id)->first();
    $survey=false;
      if($survey){
        return redirect('tablero/encuestas')->with('error',"Ya has contestado la encuesta");
      }
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
      $user   = Auth::user();
      $survey = FellowSurvey::firstOrCreate(['user_id'=>$user->id]);
      $data   = $request->except(['_token']);
      $keys   = array_keys($data);
      $to_save = [];
      foreach($keys as $d){
        if(is_array($data[$d])){
          $to_save[$d] = current(array_slice($data[$d], 0, 1));
        }else{
          $to_save[$d] =$data[$d];
        }
      }
    FellowSurvey::where('id',$survey->id)->update($to_save);
    return redirect('tablero/encuestas/encuesta-satisfaccion/gracias')->with('success',"Se ha guardado correctamente");

    }
}
