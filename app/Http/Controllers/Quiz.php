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
          $questions = $activity->quizInfo->question;
          $answers   = [];
          foreach($questions as $question){
            if($question->answer){
              foreach($question->answer as $answer){
                $answers[] = $answer->toArray();
              }
            }
          }

          return view('admin.modules.quiz.evaluation-add')->with([
            "user"      => $user,
            "activity"  => $activity,
            "questions" => json_encode($questions->toArray()),
            "answers" => json_encode($answers),
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
        public function updateQuestions(Request $request)
        {
           $question = Question::find($request->id);
           if($request->question){
            $question->question = $request->question;
            $question->save();
          }
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
          $answer  = new Answer();
          if($request->question){
            $answer->question_id = $request->question;
            $answer->value       = $request->value;
            $answer->selected    = 0;
            $answer->save();
          }
          return response()->json($answer->toArray());

        }

        /**
         * Muestra lista de respuestas de diagnostico general
         *
         * @return \Illuminate\Http\Response
         */
        public function updateAnswer(Request $request)
        {
          $answer = Answer::find($request->id);
          if($request->value){
           $answer->value = $request->value;
           $answer->save();
         }
          return response()->json($answer->toArray());

        }
        /**
         * Muestra lista de respuestas de diagnostico general
         *
         * @return \Illuminate\Http\Response
         */
        public function removeAnswer(Request $request)
        {
          $answer = Answer::find($request->opt['id']);
          if($answer->question->answer_id === $request->opt['id']){
            $question = Question::find($answer->question_id);
            $question->answer_id =null;
            $question->save();
          }
          $answer->delete();
          return response()->json(["response"=>"ok"]);

        }

        /**
         * Muestra lista de respuestas de diagnostico general
         *
         * @return \Illuminate\Http\Response
         */
        public function switchAnswer(Request $request)
        {
          $answer = Answer::find($request->opt['id']);
          $question = Question::find($answer->question_id);
          if($answer->selected){
            $answer->selected = 0;
            $answer->save();
            $question->answer_id =null;
            $question->save();
          }else{
            $answer->selected = 1;
            $answer->save();
            $question->answer_id =$answer->id;
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
          $questions = Question::where('quizInfo_id',$request->idQuiz)->get();
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
          $quiz = QuizInfo::find($quizId);
          if($quiz->question->count()>0){
            foreach ($quiz->question as $question) {
              if($question->answer->count()>0){
                  $selected = Answer::where('selected',1)->where('question_id',$question->id)->get();
                  if($selected->count()==0){
                    return redirect("dashboard/sesiones/actividades/evaluacion/agregar/$activity_id/2")->with('error',"La pregunta: '$question->question' no cuenta con respuesta correcta");
                  }
              }else{
                return redirect("dashboard/sesiones/actividades/evaluacion/agregar/$activity_id/2")->with('error',"La pregunta: '$question->question' no cuenta con respuesta");
              }
            }
            return redirect("dashboard/sesiones/actividades/ver/$activity_id");

          }else{
            return redirect("dashboard/sesiones/actividades/evaluacion/agregar/$activity_id/2")->with('error','No se ha agregado ninguna pregunta');
          }

        }

}
