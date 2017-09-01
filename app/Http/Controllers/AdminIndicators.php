<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Excel;
use App\Models\Module;
use App\Models\FacilitatorModule;
use App\Models\FacilitatorSurvey;
use App\Models\FellowSurvey;
use App\Models\ModuleSession;
use PDF;
class AdminIndicators extends Controller
{
    //

    /**
     * Muestra lista para descargar indicadores
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $user       = Auth::user();
      return view('admin.indicators.indicators-list')->with([
        "user"      => $user,
      ]);

    }


    /**
     * Genera excel con indicadores de facilitadores
     *
     * @return \Illuminate\Http\Response
     */
    public function downloadFacilitator($session_id,$facilitator_id)
    {
      $user            = Auth::user();
      $facilitatorData = FacilitatorSurvey::where('session_id',$session_id)->where('facilitator_id',$facilitator_id)->firstOrFail();
      $path  = base_path().'/csv/reports/modulo_curso_1_'.$facilitatorData->facilitator->id.'.pdf';
      return response()->download($path);
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
      //a un solo módulo
      $modules_ids = FacilitatorModule::pluck('module_id');
      $modules  = Module::where('title','CURSO 1 - Gobierno Abierto y los ODS')->where('start','<=',$today)->where('public',1)->whereIn('id',$modules_ids->toArray())->orderBy('start','asc')->get();
      return view('admin.indicators.survey-fac-module-list')->with([
        'user'=>$user,
        'modules' =>$modules
      ]);

    }

    /**
     * Muestra resultados de encuestas para el facilitador y sesión
     *
     * @return \Illuminate\Http\Response
     */
    public function surveyFacilitator($session_id,$facilitator_id)
    {
      $user            = Auth::user();
      $facilitatorData = FacilitatorSurvey::where('session_id',$session_id)->where('facilitator_id',$facilitator_id)->firstOrFail();
      $all             = FacilitatorSurvey::where('session_id',$session_id)->where('facilitator_id',$facilitator_id)->get();
      return view('admin.indicators.survey-facilitator')->with([
        "user"      => $user,
        "facilitatorData"   => $facilitatorData,
        "all"      => $all
      ]);
    }


    /**
     * Muestra resultados de encuestas satisfaccion
     *
     * @return \Illuminate\Http\Response
     */
    public function surveySatisfaction()
    {
      $user            = Auth::user();
      $all             = FellowSurvey::orderBy('created_at','desc')->get();
      return view('admin.indicators.survey-satisfaction')->with([
        "user"      => $user,
        "all"      => $all
      ]);
    }


    /**
     * Genera excel con indicadores de fellows
     *
     * @return \Illuminate\Http\Response
     */
    public function downloadFellows()
    {
      $all             = FellowSurvey::orderBy('created_at','desc')->get();
      $name            = 'encuesta_satisfaccion.pdf';
      $path            = base_path().'/csv/reports/'.$name;
      $pdf             = PDF::loadView('admin.indicators.pdf.fellow-survey-template', compact(['all']))->setPaper('a4', 'landscape')->save($path);

      $path  = base_path().'/csv/reports/encuesta_satisfaccion.pdf';
      return response()->download($path);
    }


    protected function get_score_session_facilitator($session,$facilitator){

    }
}
