<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\Module;
use App\Models\FacilitatorModule;
use App\Models\FellowSurvey;
use App\Models\FacilitatorSurvey;
class AdminSurveys extends Controller
{
    //
    //Paginación
    public $pageSize = 10;

    /**
     * Muestra lista para ver resultado de encuestas
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $user       = Auth::user();
      return view('admin.surveys.survey-list')->with([
        "user"      => $user,
      ]);

    }

    /**
     * Muestra resultados de encuestas para el facilitador y sesión
     *
     * @return \Illuminate\Http\Response
     */
    public function indexFellows()
    {
      $user       = Auth::user();
      $fellows    = FellowSurvey::orderBy('created_at','desc')->paginate($this->pageSize);
      return view('admin.surveys.survey-satisfaction-list-fellows')->with([
        "user"      => $user,
        "fellows"   => $fellows
      ]);
    }


    /**
     * Muestra resultados de encuestas para el facilitador y sesión
     *
     * @return \Illuminate\Http\Response
     */
    public function surveyFellow($fellow_id)
    {
      $user       = Auth::user();
      $fellow     = FellowSurvey::where('id',$fellow_id)->firstOrFail();
      return view('admin.surveys.survey-fellow')->with([
        "user"      => $user,
        "fellow"   => $fellow
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
          //a un solo módulo
          $modules_ids = FacilitatorModule::pluck('module_id');
          $modules  = Module::where('title','CURSO 1 - Gobierno Abierto y los ODS')->where('start','<=',$today)->where('public',1)->whereIn('id',$modules_ids->toArray())->orderBy('start','asc')->get();
          return view('admin.surveys.survey-module-list')->with([
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
          return view('admin.surveys.survey-facilitator')->with([
            "user"      => $user,
            "facilitatorData"   => $facilitatorData,
            "all"      => $all
          ]);
        }

        /* Obtiene el csv de los resultados del facilitador
        *
        * @return \Illuminate\Http\Response
        */
        public function getCsv($file_name){
          $path = base_path().'/csv/survey_fac_results/'.$file_name;
          return response()->file($path);
        }

        /* Obtiene el csv de los resultados de encuesta satisfaccion
        *
        * @return \Illuminate\Http\Response
        */
        public function get_csv($file_name){
          $path = base_path().'/csv/survey_fellow_results/'.$file_name;
          return response()->file($path);
        }
}
