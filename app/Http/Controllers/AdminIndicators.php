<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Excel;
use App\Models\Module;
use App\Models\FacilitatorModule;
use App\Models\FacilitatorSurvey;
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
    public function downloadFacilitators()
    {
      $module  = Module::where('title','CURSO 1 - Gobierno Abierto y los ODS')->first();
      Excel::create('indicadores_facilitadores', function($excel) use($module){
        // Set the title
        $excel->setTitle('Indicadores de percepción positiva de facilitadores');
        // Chain the setters
        $excel->setCreator('Gobierno Fácil')
              ->setCompany('Gobierno Fácil');
        // Call them separately
        $excel->setDescription('Proporción de facilitadores evaluados favorablemete por parte de los agentes de cambio');
        $excel->sheet('Curso 1', function($sheet)use($module){
          $sheet->row(1, [$module->title,'','']);
          $sheet->row(1, function($row) {
            $row->setBackground('#000000');
            $row->setFontColor('#ffffff');
          });
          $sheet->row(2, ['Sesión','Facilitador','Percepción positiva']);
          $sheet->row(2, function($row) {
            $row->setBackground('#000000');
            $row->setFontColor('#ffffff');
          });
          foreach ($module->sessions as $session) {
            foreach($session->facilitators as $facilitator){
             if($facilitator->user->email != 'contacto@prosociedad.org') {
                $sheet->appendRow([$session->name,$facilitator->user->name]);
              }
            }
          }
        });

    })->download('xlsx');

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
     * Genera excel con indicadores de fellows
     *
     * @return \Illuminate\Http\Response
     */
    public function downloadFellows()
    {

    }


    protected function get_score_session_facilitator($session,$facilitator){

    }
}
