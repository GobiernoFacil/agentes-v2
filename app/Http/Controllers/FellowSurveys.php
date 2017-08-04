<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\FellowSurvey;
use App\Models\Module;
use App\Models\ModuleSession;
// FormValidators
use App\Http\Requests\SaveSatisfactionSurvey;
class FellowSurveys extends Controller
{
    //

    /**
     * index de encuestas
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $user     = Auth::user();
      return view('fellow.surveys.survey-list')->with([
        'user'=>$user,
      ]);

    }

    /**
     * bienvenida
     *
     * @return \Illuminate\Http\Response
     */
    public function welcome()
    {
      $user     = Auth::user();
      $survey   = FellowSurvey::where('user_id',$user->id)->first();
      if($survey){
        return redirect('tablero/encuestas')->with('error',"Ya has contestado la encuesta");
      }
      return view('fellow.surveys.survey-welcome')->with([
        'user'=>$user,
      ]);

    }

    /**
     * Muestra encuesta satisfaccion
     *
     * @return \Illuminate\Http\Response
     */
    public function addSurvey()
    {
      $user     = Auth::user();
      $survey   = FellowSurvey::where('user_id',$user->id)->first();
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
    return redirect('tablero/encuestas/gracias')->with('success',"Se ha guardado correctamente");

    }

    /**
     * Muestra encuesta satisfaccion
     *
     * @return \Illuminate\Http\Response
     */
    public function thanks()
    {
      $user     = Auth::user();
      return view('fellow.surveys.survey-thanks')->with([
        'user'=>$user,
      ]);

    }

    /**
     * index de modulos
     *
     * @return \Illuminate\Http\Response
     */
    public function indexModules()
    {
      $user     = Auth::user();
      $today    = date('Y-m-d');
      $modules  = Module::where('start','<=',$today)->where('public',1)->get();
      return view('fellow.surveys.survey-module-list')->with([
        'user'=>$user,
        'modules' =>$modules
      ]);

    }

    /**
     * index de sesiones del modulo
     *
     * @return \Illuminate\Http\Response
     */
    public function indexSessions($module_slug)
    {
      $user     = Auth::user();
      $module   = Module::where('slug',$module_slug)->firstOrFail();
      $sessions = $module->sessions;
      return view('fellow.surveys.survey-sessions-list')->with([
        'user'=>$user,
        'module'=>$module,
        'sessions' =>$sessions
      ]);

    }

    /**
     * index de facilitadores de la sesión
     *
     * @return \Illuminate\Http\Response
     */
    public function indexFacilitator($session_slug)
    {
      $user         = Auth::user();
      $session      = ModuleSession::where('slug',$session_slug)->firstOrFail();
      $facilitators = $session->facilitators;
      return view('fellow.surveys.survey-facilitator-list')->with([
        'user'=>$user,
        'session'=>$session,
        'facilitators' =>$facilitators
      ]);

    }

    /**
     * Muestra encuesta de facilitador
     *
     * @return \Illuminate\Http\Response
     */
    public function surveyFacilitator()
    {
      $user     = Auth::user();

    }

}
