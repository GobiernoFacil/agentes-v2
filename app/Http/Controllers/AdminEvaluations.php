<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
// models
use App\Models\DiagnosticAnswer;
use App\Models\DiagnosticEvaluation;
use App\Models\Activity;
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
    public function evaluateDignostic_1($id)
    {
      $user       = Auth::user();
      $answers    = DiagnosticAnswer::find($id);
      $evaluation = DiagnosticAnswer::firstOrCreate(["user_id"=>$answers->user->id]);
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
}
