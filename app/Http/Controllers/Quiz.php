<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
// models
use App\Models\Activity;
use App\Models\QuizInfo;
use App\Models\Question;
use App\Models\Answer;
// FormValidators
use App\Http\Requests\SaveQuiz;
class Quiz extends Controller
{
    //


    /**
     * Agregar cuestionario
     *
     * @return \Illuminate\Http\Response
     */
    public function add($activity_id)
    {
        //
        $user      = Auth::user();
        $activity   = Activity::where('id',$activity_id)->firstOrFail();
        return view('admin.modules.quiz.quiz-add')->with([
          "user"      => $user,
          "activity" => $activity
        ]);
    }



        /**
         * Agregar cuestionario
         *
         * @return \Illuminate\Http\Response
         */
        public function save(SaveQuiz $request)
        {
            //
            $user      = Auth::user();
            $activity  = Activity::where('id',$request->activity_id)->firstOrFail();
            $quiz      = new QuizInfo($request->only(['title','description']));
            $quiz->activity_id = $activity->id;
            $quiz->save();
            return redirect("dashboard/sesiones/actividades/evaluacion/agregar/$activity->id/2")->with('success','Se ha guardado correctamente');

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
          return view('admin.modules.quiz.evaluation-add')->with([
            "user"      => $user,
            "activity"  => $activity
          ]);

        }


        /**
         * Muestra lista de respuestas de diagnostico general
         *
         * @return \Illuminate\Http\Response
         */
        public function saveQuestion(Request $request)
        {

           $question = new Question();
           $question->quizInfo_id = $request->idQuiz;
           $question->question   = $request->question;
           $question->value   = "string";
           $question->save();
           return response()->json($question->toArray());
        }

        /**
         * Muestra lista de respuestas de diagnostico general
         *
         * @return \Illuminate\Http\Response
         */
        public function removeQuestion(Request $request)
        {
          $question  = Question::find($request->id);
          foreach($question->answer as $answer){
            $answer->delete();
          }
          $question->delete();
          return response()->json(["response"=>"ok"]);

        }

        /**
         * Muestra lista de respuestas de diagnostico general
         *
         * @return \Illuminate\Http\Response
         */
        public function saveAnswer(Request $request)
        {
          var_dump($request->toArray());
          return response()->json(["id"=>"oasdasdk"]);

        }

}
