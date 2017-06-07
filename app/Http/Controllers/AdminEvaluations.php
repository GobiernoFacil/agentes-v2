<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
// models
use App\Models\DiagnosticAnswer;
use App\Models\DiagnosticEvaluation;
use App\Models\Activity;
// FormValidators
use App\Http\Requests\SaveDiagnosticEvaluation1;
class AdminEvaluations extends Controller
{
    //

    //Paginación
    public $pageSize = 10;
    /**
     * Muestra lista de respuestas de diagnostico general
     *
     * @return \Illuminate\Http\Response
     */
    public function all()
    {
      $user      = Auth::user();
      $answers   = DiagnosticAnswer::orderBy('created_at','desc')->paginate($this->pageSize);
      return view('admin.evaluations.diagnostic-list')->with([
        "user"      => $user,
        "answers"   => $answers,
      ]);

    }

    /**
     * Muestra lista de respuestas de diagnostico general
     *
     * @return \Illuminate\Http\Response
     */
    public function view($id)
    {
      $user      = Auth::user();
      $answers   = DiagnosticAnswer::find($id);
      return view('admin.evaluations.diagnostic-view')->with([
        "user"      => $user,
        "answers"   => $answers,
      ]);

    }


    /**
     * Muestra lista de respuestas de diagnostico general
     *
     * @return \Illuminate\Http\Response
     */
    public function evaluateDiagnostic_1($id)
    {
      $user       = Auth::user();
      $answers    = DiagnosticAnswer::find($id);
      $evaluation = DiagnosticEvaluation::firstOrCreate(["user_id"=>$answers->user->id]);
      return view('admin.evaluations.diagnostic-evaluation')->with([
        "user"      => $user,
        "answers"   => $answers,
        "evaluation" => $evaluation
      ]);

    }

    /**
     * Muestra lista de respuestas de diagnostico general
     *
     * @return \Illuminate\Http\Response
     */
    public function saveDiagnostic_1(SaveDiagnosticEvaluation1 $request)
    {
      $user       = Auth::user();
      $evaluation = DiagnosticEvaluation::find($request->evaluation_id);
      $evaluation->answer_q1_1 = current(array_slice($request->answer_q1_1, 0, 1));
      $evaluation->answer_q1_2 = current(array_slice($request->answer_q1_2, 0, 1));
      $evaluation->answer_q1_3 = current(array_slice($request->answer_q1_3, 0, 1));
      $evaluation->answer_q1_j = $request->answer_q1_j;
      $evaluation->answer_q2_1 = current(array_slice($request->answer_q2_1, 0, 1));
      $evaluation->answer_q2_2 = current(array_slice($request->answer_q2_2, 0, 1));
      $evaluation->answer_q2_j = $request->answer_q2_j;
      $evaluation->answer_q3_1 = current(array_slice($request->answer_q3_1, 0, 1));
      $evaluation->answer_q3_2 = current(array_slice($request->answer_q3_2, 0, 1));
      $evaluation->answer_q3_3 = current(array_slice($request->answer_q3_3, 0, 1));
      $evaluation->answer_q3_4 = current(array_slice($request->answer_q3_4, 0, 1));
      $evaluation->answer_q3_j = $request->answer_q1_j;
      $this->evaluateDiagnosticP1($evaluation);
      return redirect("dashboard/evaluacion/diagnostico/evaluar/2/{$evaluation->user->diagnostic->id}/$request->evaluation_id");

    }

    /**
     * Muestra lista de respuestas de diagnostico general
     *
     * @return \Illuminate\Http\Response
     */
    public function evaluateDiagnostic_2($answers_id,$evaluation_id)
    {
      $user       = Auth::user();
      $answers    = DiagnosticAnswer::find($answers_id);
      $evaluation = DiagnosticEvaluation::where("id",$evaluation_id)->firstOrFail();
      return view('admin.evaluations.diagnostic-evaluation_2')->with([
        "user"      => $user,
        "answers"   => $answers,
        "evaluation" => $evaluation
      ]);

    }


    /**
     * Muestra lista de respuestas de diagnostico general
     *
     * @return \Illuminate\Http\Response
     */
    public function add($activity_id)
    {
      $user      = Auth::user();
      $activity  = Activity::where('id',$activity_id)->firstOrFail();
      return view('admin.evaluations.evaluation-add')->with([
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
       $res  = $request->toArray();
       $res["id"] = uniqid();
       return response()->json($res);
    }


    protected function evaluateDiagnosticP1($evaluation){
      $answer_1_ponderation = 0;
      $value_q_1 = 20/3;
      $answer_2_ponderation = 0;
      $value_q_2 = 20/2;
      $answer_3_ponderation = 0;
      $value_q_3 = (20/4);
      //evaluate q1
      if($evaluation->answer_q1_1){
        $answer_1_ponderation = $answer_1_ponderation+$value_q_1;
      }
      if($evaluation->answer_q1_2){
        $answer_1_ponderation = $answer_1_ponderation+$value_q_1;
      }
      if($evaluation->answer_q1_3){
        $answer_1_ponderation = $answer_1_ponderation+$value_q_1;
      }
      $evaluation->answer_ponderation_1 = $answer_1_ponderation;
      //evaluate q2
      if($evaluation->answer_q2_1){
        $answer_2_ponderation = $answer_2_ponderation+$value_q_2;
      }
      if($evaluation->answer_q2_2){
        $answer_2_ponderation = $answer_2_ponderation+$value_q_2;
      }
      $evaluation->answer_ponderation_2 = $answer_2_ponderation;
      //evaluate q2
      if($evaluation->answer_q3_1){
        $answer_3_ponderation = $answer_3_ponderation+$value_q_3;
      }
      if($evaluation->answer_q3_2){
        $answer_3_ponderation = $answer_3_ponderation+$value_q_3;
      }
      if($evaluation->answer_q3_3){
        $answer_3_ponderation = $answer_3_ponderation+$value_q_3;
      }
      if($evaluation->answer_q3_4){
        $answer_3_ponderation = $answer_3_ponderation+$value_q_3;
      }
      $evaluation->answer_ponderation_3 = $answer_3_ponderation;
      $evaluation->total_score =  $answer_1_ponderation+$answer_2_ponderation+$answer_3_ponderation;
      $evaluation->save();
      return true;

    }
}
