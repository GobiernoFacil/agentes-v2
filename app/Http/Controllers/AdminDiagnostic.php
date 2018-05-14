<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\Activity;
use App\Models\CustomQuestionnaire;
use App\Models\CustomQuestion;
use App\Models\CustomFellowAnswer;
use App\Models\CustomAnswer;
// FormValidators
use App\Http\Requests\SaveCustomDiagnostic;
class AdminDiagnostic extends Controller
{
    //


        /**
         * Ver pruebas diagnostico
         *
         * @return \Illuminate\Http\Response
         */
        public function index()
        {
            //
            $user            = Auth::user();
            $questionnaires  = CustomQuestionnaire::orderBy('created_at','desc')->get();
            return view('admin.diagnostic.all-list')->with([
              "user"      => $user,
              "questionnaires" => $questionnaires
            ]);
        }

        /**
         * Ver pruebas diagnostico
         *
         * @return \Illuminate\Http\Response
         */
        public function getCustom($id)
        {
            //
            $user            = Auth::user();
            $questionnaire  = CustomQuestionnaire::where('id',$id)->firstOrFail();
            return view('admin.diagnostic.custom-view')->with([
              "user"      => $user,
              "questionnaire" => $questionnaire
            ]);
        }

        /**
         * descargar
         *
         * @return \Illuminate\Http\Response
         */
        public function download($type,$id)
        {
            //
             $path = base_path().'/csv/reports/cuestionario_diagnostico_'.$id;
             $name = 'cuestionario_diagnostico_'.$id;
            if($type==='pdf'){
              $file = $path.'.pdf';
              $mime = mime_content_type ($file);
              $headers = array(
                'Content-Type: '.$mime,
              );
              return response()->download($file, $name.'.pdf', $headers);
            }elseif($type==='xlsx'){
              $file = $path.'.xlsx';
              $mime = mime_content_type ($file);
              $headers = array(
                'Content-Type: '.$mime,
              );
              return response()->download($file, $name.'.xlsx', $headers);
            }

        }

        /**
         * Agregar cuestionario diagnostico
         *
         * @return \Illuminate\Http\Response
         */
        public function add($activity_id)
        {
            //
            $user      = Auth::user();
            $activity   = Activity::where('id',$activity_id)->firstOrFail();
            return view('admin.modules.diagnostic.quiz-add')->with([
              "user"      => $user,
              "activity" => $activity
            ]);
        }


        /**
         * Agregar cuestionario
         *
         * @return \Illuminate\Http\Response
         */
        public function save(SaveCustomDiagnostic $request)
        {
            //
            $user      = Auth::user();
            $activity  = Activity::where('id',$request->activity_id)->firstOrFail();
            $quiz      = CustomQuestionnaire::firstOrCreate(['activity_id' => $request->activity_id]);
            $quiz->title = $request->title;
            $quiz->slug  = str_slug($request->title);
            $quiz->description = $request->description;
            $quiz->type  = 'activity';
            $quiz->user_id  = $user->id;
            $quiz->save();
            return redirect("dashboard/sesiones/actividades/diagnostico/agregar/$activity->id/2")->with('success','Se ha guardado correctamente');

        }

        /**
         * Muestra lista de respuestas de diagnostico general
         *
         * @return \Illuminate\Http\Response
         */
        public function addQuestion($activity_id)
        {
          $user      = Auth::user();
          $activity  = Activity::where('id',$activity_id)->firstOrFail();
          $questions = $activity->diagnosticInfo->questions;
          $answers   = [];
          foreach($questions as $question){
            if($question->answers){
              foreach($question->answers as $answer){
                $answers[] = $answer->toArray();
              }
            }
          }

          return view('admin.modules.diagnostic.evaluation-add')->with([
            "user"      => $user,
            "activity"  => $activity,
            "questions" => json_encode($questions->toArray()),
            "answers"   => json_encode($answers),
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
             $question->options_columns_number  = 1;
             $question->options_rows_number     = 5;
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
        public function checkAnswers($quizId,$activity_id)
        {
          $user = Auth::user();
          $quiz = CustomQuestionnaire::where('id',$quizId)->firstOrFail();
          if($quiz->questions->count()>0){
            foreach ($quiz->questions as $question) {
              if($question->type === 'answers'){
                if(!$question->answers->count()){
                  return redirect("dashboard/sesiones/actividades/diagnostico/agregar/$activity_id/2")->with('error',"La pregunta: '$question->question' no cuenta con respuesta");
                }
              }
            }
            return redirect("dashboard/sesiones/actividades/ver/$activity_id");

          }else{
            return redirect("dashboard/sesiones/actividades/diagnostico/agregar/$activity_id/2")->with('error','No se ha agregado ninguna pregunta');
          }

        }

}
