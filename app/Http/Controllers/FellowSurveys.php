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
use App\Models\CustomQuestion;
use App\Models\CustomFellowAnswer;
use App\Models\Program;
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
    public function index($program_slug)
    {
      $user     = Auth::user();
      $program  = $user->actual_program();
      $surveys  = CustomQuestionnaire::where('type','general')->where('program_id',$program->id)
      ->orWhere(function($query)use($program){
        $query->where('type','facilitator')->where('program_id',$program->id);
      })
      ->orderBy('created_at','desc')
      ->get();
      return view('fellow.surveys.survey-list')->with([
        'user'    => $user,
        'program' => $program,
        'surveys' => $surveys
      ]);

    }

    /**
     * bienvenida
     *
     * @return \Illuminate\Http\Response
     */
    public function welcome($program_slug,$survey_slug)
    {
      $user     = Auth::user();
      $program  = Program::where('slug',$program_slug)->firstOrFail();
      $survey   = CustomQuestionnaire::where('slug',$survey_slug)->where('program_id',$program->id)->firstOrFail();
      if($user->fellow_survey($survey->id)->count() == $survey->questions->count()){
        return redirect("tablero/$program->slug/encuestas")->with('error',"Ya has contestado la encuesta");
      }
      $answersAlr = $user->fellow_survey($survey->id)->pluck('question_id')->toArray();
      $fellow_questions = $survey->questions()->select('question','id','type', 'required')->whereNotIn('id',$answersAlr)->get();

      return view('fellow.surveys.survey-welcome')->with([
        'user'              => $user,
        'survey'            => $survey,
        'program'           => $program,
        'fellow_questions' => $fellow_questions
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
    public function thanks($program_slug,$survey_slug)
    {
         $user     = Auth::user();
         $program  = Program::where('slug',$program_slug)->firstOrFail();
         $survey   = CustomQuestionnaire::where('slug',$survey_slug)->firstOrFail();

         if(CustomFellowAnswer::where('user_id',$user->id)->where('questionnaire_id',$survey->id)->count() != $survey->questions->count()){
           return redirect("tablero/{$program->slug}/encuestas/{$survey->slug}")
           ->with(['error'=>'Ocurrió un error, por favor intentalo nuevamente o contacta a soporte']);
         }
         return view('fellow.surveys.survey-thanks')->with([
           'user'    => $user,
           'program' => $program
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

      $module_survey_2  = Module::where('title','CURSO 2 - Herramientas para la Acción')->first();
      $user_sur         = FacilitatorModule::where('module_id',$module_survey_2->id)->pluck('user_id');
      $q_fac            = CustomQuestionnaire::where('type','facilitator')->first();
      $custom_number_q  = CustomFellowAnswer::where('questionnaire_id',$q_fac->id)->where('user_id',$user->id)->whereIn('facilitator_id',$user_sur->toArray())->distinct('facilitator_id')->count('facilitator_id');

      $module_survey_3  = Module::where('title','CURSO 3 - Aterrizaje: "Ya tengo mi agenda, y ahora qué..."')->first();
      $non_email_list   = ['roberto.moreno@inai.org.mx'];
      $non_user_sur     = User::whereIn('email',$non_email_list)->pluck('id');
      $user_sur_3       = FacilitatorModule::where('module_id',$module_survey_3->id)->pluck('user_id');
      $custom_number_q_3  = CustomFellowAnswer::where('questionnaire_id',$q_fac->id)->where('user_id',$user->id)->whereIn('facilitator_id',$user_sur->toArray())->whereNotIn('facilitator_id',$non_user_sur->toArray())->distinct('facilitator_id')->count('facilitator_id');

      if($custom_number_q != sizeof($user_sur) && $custom_number_q_3 != sizeof($user_sur_3)){
          $modules->push($module_survey_3);
      }else{
        if($custom_number_q != sizeof($user_sur) && $custom_number_q_3 == sizeof($user_sur_3)){
          $modules = $module_survey_2;
        }else{
          $modules = $module_survey_3;
        }
      }


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


        /**
        *
        *
        * @return \Illuminate\Http\Response
        */
        public function saveAnswer(Request $request){
           $user     = Auth::user();
           $question = CustomQuestion::find($request->question_id);
           $cool     = true;
           if($question->type === 'open'){
             $answer = CustomFellowAnswer::firstOrCreate([
               'user_id'          => $user->id,
               'question_id'      => $request->question_id,
               'answer'           => $request->answer,
               'questionnaire_id' => $question->questionnaire_id

             ]);
           }elseif($question->type === 'answers'){
             $answer = CustomFellowAnswer::firstOrCreate([
               'user_id'          => $user->id,
               'question_id'      => $request->question_id,
               'answer_id'        => $request->answer,
               'questionnaire_id' => $question->questionnaire_id

             ]);
           }elseif($question->type === 'radio'){
             $answer = CustomFellowAnswer::firstOrCreate([
               'user_id'          => $user->id,
               'question_id'      => $request->question_id,
               'answer'           => $request->answer,
               'questionnaire_id' => $question->questionnaire_id

             ]);
           }else{
             $cool     = false;
           }

           return response()->json(["response" => $cool]);


        }


}
