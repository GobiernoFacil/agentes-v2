<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\Module;
use App\Models\FacilitatorModule;
class AdminSurveys extends Controller
{
    //

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
        }
}
