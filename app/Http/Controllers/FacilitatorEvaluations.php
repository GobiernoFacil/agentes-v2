<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
// models
use App\Models\DiagnosticAnswer;
class FacilitatorEvaluations extends Controller
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
    return view('facilitator.evaluations.diagnostic-list')->with([
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
    return view('facilitator.evaluations.diagnostic-view')->with([
      "user"      => $user,
      "answers"   => $answers,
    ]);

  }
}
