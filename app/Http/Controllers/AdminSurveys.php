<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\Module;
use App\Models\FacilitatorModule;
use App\Models\FellowSurvey;
use App\Models\FacilitatorSurvey;
use App\Models\CustomQuestionnaire;
use App\Models\ModuleSession;
use App\User;
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
      $custom     = CustomQuestionnaire::whereNull('type')->get();
      return view('admin.surveys.survey-list')->with([
        "user"      => $user,
        "custom"    => $custom
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
          $modules  = Module::where('title','CURSO 1 - Gobierno Abierto y los ODS')
          ->orWhere(function($query){
            $query->where('title','CURSO 2 - Herramientas para la Acción');
          })
          ->orWhere(function($query){
            $query->where('title','CURSO 3 - Aterrizaje: "Ya tengo mi agenda, y ahora qué..."');
          })
          ->where('start','<=',$today)->where('public',1)->whereIn('id',$modules_ids->toArray())->orderBy('start','asc')
          ->get();
          $questionnaire = CustomQuestionnaire::where('type','facilitator')->first();
          return view('admin.surveys.survey-module-list')->with([
            'user'=>$user,
            'modules' =>$modules,
            'questionnaire'=>$questionnaire
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


        /**
         * Muestra resultados de encuestas
         *
         * @return \Illuminate\Http\Response
         */
        public function customSurvey($id)
        {
          $user            = Auth::user();
          $questionnaire   = CustomQuestionnaire::where('id',$id)->firstOrFail();
          return view('admin.surveys.survey-custom')->with([
            "user"      => $user,
            "questionnaire"   => $questionnaire,
          ]);
        }

        /**
         * Muestra resultados de encuestas
         *
         * @return \Illuminate\Http\Response
         */
        public function customFacilitator($session_id,$facilitator_id)
        {
          $user            = Auth::user();
          $questionnaire   = CustomQuestionnaire::where('type','facilitator')->firstOrFail();
          $facilitatorData = User::where('id',$facilitator_id)->firstOrFail();
          $session         = ModuleSession::where('id',$session_id)->firstOrFail();
          return view('admin.surveys.survey-facilitator-custom')->with([
            "user"      => $user,
            "questionnaire"   => $questionnaire,
            'facilitatorData' => $facilitatorData,
            'session'         => $session
          ]);
        }
}
