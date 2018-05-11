<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\Activity;
use App\Models\CustomQuestionnaire;
use App\Models\CustomFellowAnswer;
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
            if($question->answer){
              foreach($question->answer as $answer){
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
}
