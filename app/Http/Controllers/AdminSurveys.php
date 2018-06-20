<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Excel;
use App\Models\Module;
use App\Models\FacilitatorModule;
use App\Models\FellowSurvey;
use App\Models\FacilitatorSurvey;
use App\Models\CustomQuestionnaire;
use App\Models\CustomQuestion;
use App\Models\CustomAnswer;
use App\Models\ModuleSession;
use App\Models\Program;
use App\User;

use App\Http\Requests\SaveGeneralSurvey;
use App\Http\Requests\UpdateGeneralSurvey;
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
    public function indexProgram()
    {
      $user       = Auth::user();
      $programs   = Program::orderBy('start','desc')->paginate($this->pageSize);
      return view('admin.surveys.survey-program-list')->with([
        "user"         => $user,
        "programs"    => $programs
      ]);

    }

    /**
     * Muestra lista para ver resultado de encuestas
     *
     * @return \Illuminate\Http\Response
     */
    public function index($program_id)
    {
      $user       = Auth::user();
      $program    = Program::where('id',$program_id)->firstOrFail();
      $surveys    = CustomQuestionnaire::where('type','general')->where('program_id',$program_id)
      ->orWhere(function($query)use($program_id){
        $query->where('type','facilitator')->where('program_id',$program_id);
      })
      ->get();
      return view('admin.surveys.survey-list')->with([
        "user"      => $user,
        "surveys"   => $surveys,
        "program"   => $program
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
     * Muestra view de encuestas
     *
     * @return \Illuminate\Http\Response
     */
    public function view($program_id,$survey_id)
    {
      $user       = Auth::user();
      $program    = Program::where('id',$program_id)->firstOrFail();
      $survey     = CustomQuestionnaire::where('id',$survey_id)->firstOrFail();
      return view('admin.surveys.survey-view')->with([
        "user"      => $user,
        "program"   => $program,
        "survey"    => $survey
      ]);
    }

    /**
     * Muestra formulario para agregar encuestas
     *
     * @return \Illuminate\Http\Response
     */
    public function add($program_id)
    {
      $user       = Auth::user();
      $program    = Program::where('id',$program_id)->firstOrFail();
      return view('admin.surveys.survey-add')->with([
        "user"      => $user,
        "program"   => $program
      ]);
    }

    /**
     * Muestra formulario para agregar encuestas
     *
     * @return \Illuminate\Http\Response
     */
    public function save(SaveGeneralSurvey $request)
    {
      $user       = Auth::user();
      $program    = Program::where('id',$request->program_id)->firstOrFail();
      $quiz       = CustomQuestionnaire::firstOrCreate([
        'user_id'     => $user->id,
        'title'       => $request->title,
        'description' => $request->description,
        'slug'        => str_slug($request->title),
        'type'        => $request->type,
        'program_id'  => $request->program_id
      ]);
      return redirect("dashboard/encuestas/programa/$program->id/agregar-preguntas/$quiz->id")->with(['success'=>'Se ha guardado correctamente']);
    }

    /**
     * Muestra formulario para agregar encuestas
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($program_id,$quiz_id)
    {
      $user       = Auth::user();
      $program    = Program::where('id',$program_id)->firstOrFail();
      $quiz       = CustomQuestionnaire::where('id',$quiz_id)->firstOrFail();
      return view('admin.surveys.survey-update')->with([
        "user"      => $user,
        "program"   => $program,
        "quiz"      => $quiz
      ]);
    }

    /**
     * Muestra formulario para agregar encuestas
     *
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateGeneralSurvey $request)
    {
      $user       = Auth::user();
      $program    = Program::where('id',$request->program_id)->firstOrFail();
      CustomQuestionnaire::where('id',$request->quiz_id)->update($request->only('title','description','type'));
      return redirect("dashboard/encuestas/programa/$program->id/agregar-preguntas/$request->quiz_id")->with(['success'=>'Se ha guardado correctamente']);
    }

    /**
     * Muestra formulario para agregar encuestas
     *
     * @return \Illuminate\Http\Response
     */
    public function addQuestions($program_id,$quiz_id)
    {
      $user       = Auth::user();
      $program    = Program::where('id',$program_id)->firstOrFail();
      $quiz       = CustomQuestionnaire::where('id',$quiz_id)->firstOrFail();
      $questions  = $quiz->questions;
      $answers   = [];
      foreach($questions as $question){
        if($question->answers){
          foreach($question->answers as $answer){
            $answers[] = $answer->toArray();
          }
        }
      }
      return view('admin.surveys.survey-add-questions')->with([
        "user"      => $user,
        "program"   => $program,
        "quiz"      => $quiz,
        "answers"   => json_encode($answers),
        "questions" => json_encode($questions->toArray())
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

        /**
         * Muestra lista de respuestas de diagnostico general
         *
         * @return \Illuminate\Http\Response
         */
        public function saveQuestion(Request $request)
        {

           $question =  CustomQuestion::firstOrCreate(['question'=>$request->question,'questionnaire_id'=>$request->idQuiz]);
           $question->type            = $request->type;
           $question->required        = $request->required;
           if($question->type === 'radio'){
             $question->min_label  = 'Menor';
             $question->max_label  = 'Mayor';
             $question->options_columns_number  = 5;
             $question->options_rows_number     = 1;
           }
           $question->save();
           return response()->json($question->toArray());
        }

        /**
         * Elimina pregunta de cuestionario
         *
         * @return \Illuminate\Http\Response
         */
        public function removeQuestion(Request $request)
        {
          $question  = CustomQuestion::find($request->id);
          foreach($question->answers as $answer){
            $answer->delete();
          }
          $question->delete();
          return response()->json(["response"=>"ok"]);

        }


        /**
         * Guarda respuesta de pregunta
         *
         * @return \Illuminate\Http\Response
         */
        public function saveAnswer(Request $request)
        {
          if($request->question){
            $answer = CustomAnswer::firstOrCreate(['question_id'=>$request->question,'answer'=>$request->value,'value'=>$request->value]);
            $answer->selected    = 0;
            $answer->save();
          }
          return response()->json($answer->toArray());

        }

        /**
         * Actualiza pregunta
         *
         * @return \Illuminate\Http\Response
         */
        public function updateQuestions(Request $request)
        {
           $question = CustomQuestion::find($request->id);
           if($request->question){
            $question->question = $request->question;
            $question->save();
          }
           return response()->json($question->toArray());

        }


        /**
         * Actualiza respuesta
         *
         * @return \Illuminate\Http\Response
         */
        public function updateAnswer(Request $request)
        {
          $answer = CustomAnswer::find($request->id);
          if($request->value){
           $answer->value = $request->value;
           $answer->save();
         }
          return response()->json($answer->toArray());

        }

        /**
         * Cambia de correcta a incorrecta una respuesta
         *
         * @return \Illuminate\Http\Response
         */
        public function switchAnswer(Request $request)
        {
          $answer = CustomAnswer::find($request->opt['id']);
          $question = CustomQuestion::find($answer->question_id);
          if($answer->selected){
            $answer->selected = 0;
            $answer->save();
          }else{
            $answer->selected = 1;
            $answer->save();
          }
          return response()->json(["response"=>"ok"]);

        }


        /**
         * Cambia  pregunta opcional a obligatoria y viceversa
         *
         * @return \Illuminate\Http\Response
         */
        public function switchRequired(Request $request)
        {
          $question = CustomQuestion::find($request->opt['id']);
          if($question->required){
            $question->required = 0;
            $question->save();
          }else{
            $question->required = 1;
            $question->save();
          }
          return response()->json(["response"=>"ok"]);

        }

        /**
         * Muestra lista de respuestas de diagnostico general
         *
         * @return \Illuminate\Http\Response
         */
        public function getQuestions(Request $request)
        {
          $questions = CustomQuestion::where('questionnaire_id',$request->idQuiz)->get();
          return response()->json($questions->toArray());

        }

        /**
         * Muestra lista de respuestas de diagnostico general
         *
         * @return \Illuminate\Http\Response
         */
        public function checkAnswers($program_id,$quiz_id)
        {
          $user = Auth::user();
          $quiz = CustomQuestionnaire::where('id',$quiz_id)->firstOrFail();
          if($quiz->questions->count()>0){
            foreach ($quiz->questions as $question) {
              if($question->type === 'answers'){
                if(!$question->answers->count()){
                  return redirect("dashboard/encuestas/programa/$program_id/agregar-preguntas/$quiz_id")->with('error',"La pregunta: '$question->question' no cuenta con respuesta");
                }
              }
            }
            return redirect("dashboard/encuestas/programa/$program_id/")->with(['success'=>'Se ha guardado correctamente']);

          }else{
            return redirect("dashboard/encuestas/programa/$program_id/agregar-preguntas/$quiz_id")->with('error','No se ha agregado ninguna pregunta');
          }

        }


        /**
         * descargar xlsx
         *
         * @return \Illuminate\Http\Response
         */
        public function download($program_id,$survey_id)
        {
          $headers = ["Pregunta","Comentarios"];
          $survey  = CustomQuestionnaire::where('id',$survey_id)->firstOrFail();
          Excel::create("encuesta_".$survey->title, function($excel)use($headers,$survey) {
            // Set the title
            $excel->setTitle('Resultados de encuesta');
            // Chain the setters
            $excel->setCreator('Gobierno Fácil')
                  ->setCompany('Gobierno Fácil');
            // Call them separately
            $excel->setDescription('Comentarios encuesta '.$survey->title);
            $excel->sheet('Comentarios', function($sheet)use($headers,$survey){
              $sheet->setTitle('Comentarios');
              $sheet->row(1, ["Comentarios de encuesta",$survey->title]);
              $sheet->row(2, $headers);
              $sheet->row(1, function($row) {
                $row->setBackground('#000000');
                $row->setFontColor('#ffffff');
              });
              $sheet->row(2, function($row) {
                $row->setBackground('#000000');
                $row->setFontColor('#ffffff');
              });
              foreach ($survey->questions as $question) {
                if($question->type === 'open'){

                  $values = [];
                  $values[]= $question->question;
                  $sheet->appendRow($values);
                  foreach ($question->answers_fellows as $answer) {
                      $sheet->appendRow([" ",$answer->answer]);
                  }
                }
              }
            });
          })->download('xlsx');

        }
}
