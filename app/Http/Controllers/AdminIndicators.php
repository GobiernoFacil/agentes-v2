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
use App\Models\FellowData;
use App\Models\FellowAverage;
use App\Models\Program;
use App\User;
use PDF;
class AdminIndicators extends Controller
{
  //Paginación
  public $pageSize = 10;

    /**
     * Muestra lista para ver resultado de encuestas
     *
     * @return \Illuminate\Http\Response
     */
    public function indexProgram()
    {
      $user       = Auth::user();
      $programs   = Program::orderBy('start','desc')->paginate($this->pageSize);
      return view('admin.indicators.indicator-program-list')->with([
        "user"         => $user,
        "programs"    => $programs
      ]);

    }

    /**
     * Muestra lista para descargar indicadores
     *
     * @return \Illuminate\Http\Response
     */
    public function index($program_id)
    {
      $user       = Auth::user();
      $program    = Program::where('id',$program_id)->firstOrFail();
      if($program->title === 'Programa 2017'){

        return view('admin.indicators.indicators-old-list')->with([
           "user"      => $user,
           "program"   => $program
         ]);
      }else{
        return view('admin.indicators.indicators-general-list')->with([
           "user"      => $user,
           "program"   => $program
         ]);
      }

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
     * Genera excel con indicadores de facilitadores
     *
     * @return \Illuminate\Http\Response
     */
    public function downloadFacilitatorXLSX($session_id,$facilitator_id)
    {
      $user            = Auth::user();
      $facilitatorData = FacilitatorSurvey::where('session_id',$session_id)->where('facilitator_id',$facilitator_id)->firstOrFail();
      $path  = base_path().'/csv/survey_fac_answers/mo_2_sess_'.$session_id.'_fac_'.$facilitatorData->facilitator->id.'.xlsx';
      $mime = mime_content_type ($path);
      $headers = array(
        'Content-Type: '.$mime,
      );
      return response()->download($path, 'sesion_'.$session_id.'_fac_'.$facilitatorData->facilitator->id.'.xlsx', $headers);
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
      $modules     = Module::where('title','CURSO 1 - Gobierno Abierto y los ODS')->where('start','<=',$today)->where('public',1)->whereIn('id',$modules_ids->toArray())->orderBy('start','asc')->get();
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

      $path  = base_path().'/csv/reports/encuesta_satisfaccion.pdf';
      return response()->download($path);
    }

    /**
     * Genera excel con indicadores de fellows
     *
     * @return \Illuminate\Http\Response
     */
    public function downloadFellowsXLSX()
    {

      $path  = base_path().'/csv/survey_fellow_answers/satisfaction_survey.xlsx';
      $mime = mime_content_type ($path);
      $headers = array(
        'Content-Type: '.$mime,
      );
      return response()->download($path, 'encuesta_satisfaccion.xlsx', $headers);
    }


    /**
     * Genera lista con el número de fellows por género
     *
     * @return \Illuminate\Http\Response
     */
    public function perception()
    {
      $user            = Auth::user();
      $enabled         = User::where('email','!=','andre@fcb.com')->where('type','fellow')->where('enabled',1)->pluck('id');
      $male            = FellowData::where('gender','Male')->whereIn('user_id',$enabled->toArray())->get();
      $female          = FellowData::where('gender','Female')->whereIn('user_id',$enabled->toArray())->get();
      return view('admin.indicators.perception')->with([
        "user"      => $user,
        "male"      => $male,
        "female"    => $female,
      ]);
    }

    /**
     * Genera lista con el número de fellows por género
     *
     * @return \Illuminate\Http\Response
     */
    public function fellowsApproved($program_id)
    {
      $user       = Auth::user();
      $program    = Program::where('id',$program_id)->firstOrFail();
      $test       = User::where('email','andre@fcb.com')->first();
      $enabled    = $program->fellows()->where('user_id','!=',$test->id)->pluck('user_id');
      $male            = FellowData::where('gender','Male')->whereIn('user_id',$enabled->toArray())->pluck('user_id');
      $female          = FellowData::where('gender','Female')->whereIn('user_id',$enabled->toArray())->pluck('user_id');
      if($program->title === 'Programa 2017'){
        $total_male      = FellowAverage::where('program_id',$program->id)->whereIn('user_id',$male->toArray())->where('average','>=',7)->where('type','total')->count();
        $total_female    = FellowAverage::where('program_id',$program->id)->whereIn('user_id',$female->toArray())->where('average','>=',7)->where('type','total')->count();
      }else{
        /*Nunca se tomo en cuenta el género como campo obligatorio, por eso, este cálculo no se generan o no esta completo  */
        $total_male      = FellowAverage::where('program_id',$program->id)->whereIn('user_id',$male->toArray())->where('average','>=',7)->where('type','final')->count();
        $total_female    = FellowAverage::where('program_id',$program->id)->whereIn('user_id',$female->toArray())->where('average','>=',7)->where('type','final')->count();
      }
      if($male->count()>0){
        $score_male      = ceil(($total_male*100)/$male->count());
      }else{
        $score_male      = 0;
      }
      if($female->count()>0){
        $score_female    = ceil(($total_female*100)/$female->count());
      }else{
        $score_female      = 0;
      }
      return view('admin.indicators.approved-fellows')->with([
        "user"      => $user,
        "male"      => $male,
        "female"    => $female,
        "total_male" => $total_male,
        "total_female" => $total_female,
        "score_male"=> $score_male,
        "score_female"=>$score_female,
        "program" => $program
      ]);
    }





    protected function get_score_session_facilitator($session,$facilitator){

    }
}
