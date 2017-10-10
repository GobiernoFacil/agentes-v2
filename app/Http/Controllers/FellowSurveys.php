<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Jobs\CreateCsvFacilitators;
use Auth;
use App\User;
use App\Models\FacilitatorSurvey;
use App\Models\FellowSurvey;
use App\Models\Module;
use App\Models\ModuleSession;
use App\Models\FacilitatorModule;
use App\Models\CustomQuestionnaire;
use App\Models\CustomFellowAnswer;
// FormValidators
use App\Http\Requests\SaveSatisfactionSurvey;
use App\Http\Requests\SaveFacilitatorSurvey;
// FormValidators
use App\Http\Requests\SaveCustomTest;
class FellowSurveys extends Controller
{
    //
    //Paginación
    public $pageSize = 10;

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
      //a un solo módulo
      $modules_ids = FacilitatorModule::pluck('module_id');
      //$modules  = Module::where('title','CURSO 1 - Gobierno Abierto y los ODS')->where('start','<=',$today)->where('public',1)->whereIn('id',$modules_ids->toArray())->orderBy('start','asc')->get();
      $modules  = Module::where('title','CURSO 2 - Herramientas para la Acción')->where('start','<=',$today)->where('public',1)->whereIn('id',$modules_ids->toArray())->orderBy('start','asc')->get();
      $questionnaire = CustomQuestionnaire::where('type','facilitator')->firstOrFail();
      /*
      return view('fellow.surveys.survey-module-list')->with([
        'user'=>$user,
        'modules' =>$modules
      ]);*/

      return view('fellow.surveys.survey-custom-list')->with([
        'user'=>$user,
        'modules' =>$modules,
        'questionnaire'=>$questionnaire
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
      $sessions_ids = FacilitatorModule::pluck('session_id');
      $sessions = ModuleSession::where('module_id',$module->id)->whereIn('id',$sessions_ids->toArray())->paginate($this->pageSize);;
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
     * instrucciones facilitador survey
     *
     * @return \Illuminate\Http\Response
     */
    public function welcomeFacilitator($session_slug,$name)
    {
      $user     = Auth::user();
      $session     = ModuleSession::where('slug',$session_slug)->firstOrFail();
      $facilitator = User::where('type','facilitator')->where('enabled',1)->where('name',$name)
      ->orWhere(function($query)use($name){
        $query->where('type','admin')
        ->where('enabled',1)
        ->where('name',$name);
      })
      ->firstOrFail();
      $done        = FacilitatorSurvey::where('session_id',$session->id)->where('user_id',$user->id)->where('facilitator_id',$facilitator->id)->first();
      if($done){
        return redirect("tablero/encuestas/facilitadores-sesiones/{$session->slug}")->with(['error'=>'Ya has evaluado a este facilitador para esta sesión']);
      }
      return view('fellow.surveys.survey-welcome-facilitator')->with([
        'user'=>$user,
        'session'=>$session,
        'facilitator' =>$facilitator
      ]);

    }

    /**
     * Muestra encuesta de facilitador
     *
     * @return \Illuminate\Http\Response
     */
    public function surveyFacilitator($session_slug,$name)
    {
      $user        = Auth::user();
      $session     = ModuleSession::where('slug',$session_slug)->firstOrFail();
      $facilitator = User::where('type','facilitator')->where('enabled',1)->where('name',$name)
      ->orWhere(function($query)use($name){
        $query->where('type','admin')
        ->where('enabled',1)
        ->where('name',$name);
      })
      ->firstOrFail();
      $done        = FacilitatorSurvey::where('session_id',$session->id)->where('user_id',$user->id)->where('facilitator_id',$facilitator->id)->first();
      if($done){
        return redirect("tablero/encuestas/facilitadores-sesiones/{$session->slug}")->with(['error'=>'Ya has evaluado a este facilitador para esta sesión']);
      }
      return view('fellow.surveys.survey-facilitator')->with([
        'user'=>$user,
        'session'=>$session,
        'facilitator' =>$facilitator,
        'survey'   =>$user
      ]);


    }

        /**
         * guarda encuesta satisfaccion
         *
         * @return \Illuminate\Http\Response
         */
        public function saveFacilitatorSurvey(SaveFacilitatorSurvey $request)
        {
          $user   = Auth::user();
          $session     = ModuleSession::where('slug',$request->session_slug)->firstOrFail();
          $facilitator = User::where('type','facilitator')->where('enabled',1)->where('name',$request->name)
          ->orWhere(function($query)use($request){
            $query->where('type','admin')
            ->where('enabled',1)
            ->where('name',$request->name);
          })
          ->firstOrFail();
          $survey = FacilitatorSurvey::firstOrCreate(['user_id'=>$user->id,'session_id'=>$session->id,'facilitator_id'=>$facilitator->id]);
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
        FacilitatorSurvey::where('id',$survey->id)->update($to_save);
        dispatch(new CreateCsvFacilitators($survey->id));
        return redirect("tablero/encuestas/facilitadores-sesiones/$session->slug/$facilitator->name/gracias")->with(['success'=>"Se ha guardado correctamente",'fac_survey' =>true]);

        }

        /**
         * Muestra encuesta satisfaccion
         *
         * @return \Illuminate\Http\Response
         */
        public function thanksFacilitator($session_slug,$name)
        {
          $user     = Auth::user();
          $session     = ModuleSession::where('slug',$session_slug)->firstOrFail();
          $facilitator = User::where('type','facilitator')->where('enabled',1)->where('name',$name)
          ->orWhere(function($query)use($name){
            $query->where('type','admin')
            ->where('enabled',1)
            ->where('name',$name);
          })
          ->firstOrFail();
          return view('fellow.surveys.survey-facilitator-thanks')->with([
            'user'=>$user,
            'session'=>$session,
            'facilitator'=>$facilitator
          ]);

        }

        /**
         * Muestra encuesta de facilitador
         *
         * @return \Illuminate\Http\Response
         */
        public function customFacilitator($session_slug,$name)
        {
          $user        = Auth::user();
          $session     = ModuleSession::where('slug',$session_slug)->firstOrFail();
          $facilitator = User::where('type','facilitator')->where('enabled',1)->where('name',$name)
          ->orWhere(function($query)use($name){
            $query->where('type','admin')
            ->where('enabled',1)
            ->where('name',$name);
          })
          ->firstOrFail();
          $done        = CustomFellowAnswer::where('session_id',$session->id)->where('user_id',$user->id)->where('facilitator_id',$facilitator->id)->first();
          if($done){
            return redirect("tablero/encuestas/facilitadores-sesiones/{$session->slug}")->with(['error'=>'Ya has evaluado a este facilitador para esta sesión']);
          }
          $survey      = CustomQuestionnaire::where('type','facilitator')->first();
          return view('fellow.surveys.survey-custom-facilitator')->with([
            'user'=>$user,
            'session'=>$session,
            'facilitator' =>$facilitator,
            'questionnaire'   =>$survey
          ]);


        }


        /**
         * Muestra encuesta de facilitador
         *
         * @return \Illuminate\Http\Response
         */
        public function saveCustomFacilitator(SaveCustomTest $request)
        {

          $user            = Auth::user();
          $questionnaire   = CustomQuestionnaire::where('type','facilitator')->firstOrFail();
          $session     = ModuleSession::where('id',$request->session_id)->firstOrFail();
          $facilitator = User::where('id',$request->facilitator_id)->firstOrFail();
          $count = 1;

          foreach ($questionnaire->questions as $question) {
            $name   = 'question_'.$count.'_'.$question->id;
            //multiple rows and columns type radio
            if($question->options_rows_number > 1){
               foreach ($question->answers as $answer) {
                 # code...
                 $temp_name = $name.'_'.$answer->id;
                 $data = current(array_slice($request->{$temp_name}, 0, 1));
                 $answer =
                 CustomFellowAnswer::firstOrCreate([
                 'user_id'=>$user->id,
                 'questionnaire_id'=>$questionnaire->id,
                 'question_id'=>$question->id,
                 'answer_id'=>$answer->id,
                 'facilitator_id'=>$request->facilitator_id,
                 'session_id' => $request->session_id
                 ]);
                 $answer->answer = $data;
                 $answer->save();
               }

            }elseif($question->options_rows_number === 1){
              //one row type radio
              $data = current(array_slice($request->{$name}, 0, 1));
              $answer = CustomFellowAnswer::firstOrCreate([
                'user_id'=>$user->id,
                'questionnaire_id'=>$questionnaire->id,
                'question_id'=>$question->id,
                'facilitator_id'=>$request->facilitator_id,
                'session_id' => $request->session_id
              ]);
              $answer->answer = $data;
              $answer->save();
            }else{
              //open question
                $answer = CustomFellowAnswer::firstOrCreate([
                  'user_id'=>$user->id,
                  'questionnaire_id'=>$questionnaire->id,
                  'question_id'=>$question->id,
                  'facilitator_id'=>$request->facilitator_id,
                  'session_id' => $request->session_id
                ]);
                $answer->answer = $request->{$name};
                $answer->save();
            }

            $count++;
          }

          return redirect("tablero/encuestas/facilitadores-sesiones/$session->slug/$facilitator->name/gracias")->with(['success'=>"Se ha guardado correctamente",'fac_survey' =>true]);

        }


}
