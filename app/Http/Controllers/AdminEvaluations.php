<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use File;
// models
use App\Models\DiagnosticAnswer;
use App\Models\DiagnosticEvaluation;
use App\Models\Activity;
use App\Models\FellowFile;
use App\Models\FellowScore;
use App\Models\FilesEvaluation;
use App\User;
// FormValidators
use App\Http\Requests\SaveDiagnosticEvaluation1;
use App\Http\Requests\SaveDiagnosticEvaluation2;
use App\Http\Requests\SaveFellowFileEvaluation;
class AdminEvaluations extends Controller
{
    //
    const UPLOADS = "archivos/fellows";
    const UPLOADSF = "archivos/fellowsEva";
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
     * Muestra lista de actividades a evaluar
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $user       = Auth::user();
      $activities   = Activity::where('type','evaluation')->orderBy('end','asc')->paginate($this->pageSize);
      return view('admin.evaluations.activities-list')->with([
        "user"      => $user,
        "activities"   => $activities,
      ]);

    }

    /**
     * Muestra lista de fellows con archivos para evaluar
     *
     * @return \Illuminate\Http\Response
     */
    public function indexActivity($activity_id)
    {
      $user       = Auth::user();
      $activity   = Activity::where('id',$activity_id)->firstOrFail();
      if($activity->files ==='Sí'){
        //ver fellows con archivos
        $fellows  = FellowFile::where('activity_id',$activity->id)->paginate($this->pageSize);
        return view('admin.evaluations.activities-files-list')->with([
          "user"      => $user,
          "activity"   => $activity,
          "fellows"   =>$fellows
        ]);
      }else{
        //ver fellows con examen automatico
        if(!$activity->quizInfo){
          return redirect('dashboard');
        }
        $fellows  = FellowScore::where('questionInfo_id',$activity->quizInfo->id)->paginate($this->pageSize);
        return view('admin.evaluations.activities-fellows-list')->with([
          "user"      => $user,
          "activity"   => $activity,
          "fellows"   =>$fellows
        ]);
      }


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
     * Muestra campos para evaluar archivo
     *
     * @return \Illuminate\Http\Response
     */
    public function fileEvaluation($file_id)
    {
      $user      = Auth::user();
      $data      = FellowFile::where('id',$file_id)->firstOrFail();
      $fellow    = FilesEvaluation::firstOrCreate(['fellow_id'=>$data->user_id,'activity_id'=>$data->activity_id,'user_id'=>$user->id]);
      return view('admin.evaluations.file-evaluation')->with([
        "user"      => $user,
        "data"   => $data,
        "fellow" => $fellow
      ]);

    }

    /**
     * Muestra campos para evaluar archivo
     *
     * @return \Illuminate\Http\Response
     */
    public function saveFileEvaluation(SaveFellowFileEvaluation $request)
    {
      $user = Auth::user();
      $data = FellowFile::where('id',$request->file_id)->firstOrFail();
      $eva  = FilesEvaluation::where('fellow_id',$data->user_id)->where('activity_id',$data->activity_id)->first();
      $eva->user_id = $user->id;
      $eva->fellow_id = $data->user_id;
      $eva->activity_id = $data->activity->id;
      $eva->url     = $request->url;
      $eva->score     = $request->score;
      $eva->comments = $request->comments;
      $path  = public_path(self::UPLOADSF);
      // [ SAVE THE file ]
      if($request->hasFile('file') && $request->file('file')->isValid()){
        if($eva->path){
          File::delete($eva->path);
        }
        $name = uniqid() . '.' . $request->file('file')->getClientOriginalExtension();
        $request->file('file')->move($path, $name);
        $eva->name = $request->file('file')->getClientOriginalName();
        $eva->path = $path.'/'.$name;
      }
      $eva->save();
      return redirect("dashboard/evaluacion/actividad/ver/{$data->activity->id}")->with('message','Se ha guarado correctamente');
    }

    /**
     * view evaluacion diagnostico
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
     * save evaluacion diagnostico
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
      $evaluation->answer_q3_j = $request->answer_q3_j;
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
      return view('admin.evaluations.diagnostic-evaluation-2')->with([
        "user"      => $user,
        "answers"   => $answers,
        "evaluation" => $evaluation
      ]);

    }

    /**
     * save evaluacion diagnostico
     *
     * @return \Illuminate\Http\Response
     */
    public function saveDiagnostic_2(SaveDiagnosticEvaluation2 $request)
    {
      $user       = Auth::user();
      $evaluation = DiagnosticEvaluation::find($request->evaluation_id);
      $evaluation->answer_q5_1 = current(array_slice($request->answer_q5_1, 0, 1));
      $evaluation->answer_q5_2 = current(array_slice($request->answer_q5_2, 0, 1));
      $evaluation->answer_q5_3 = current(array_slice($request->answer_q5_3, 0, 1));
      $evaluation->answer_q5_j = $request->answer_q5_j;
      $evaluation->answer_q4_1 = current(array_slice($request->answer_q4_1, 0, 1));
      $evaluation->answer_q4_2 = current(array_slice($request->answer_q4_2, 0, 1));
      $evaluation->answer_q4_j = $request->answer_q4_j;
      $this->evaluateDiagnosticP2($evaluation);
      return redirect("dashboard/evaluacion/diagnostico/ver/{$evaluation->user->diagnostic->id}");

    }

    /**
    *
    *
    * @return \Illuminate\Http\Response
    */
    public function download(Request $request){
      $user = Auth::user();
      $data = FellowFile::find($request->file_id);
      $file = $data->path;
      $ext  = substr(strrchr($file,'.'),1);
      $mime = mime_content_type ($file);
      $headers = array(
        'Content-Type: '.$mime,
      );

      $filename = $data->name.".".$ext;
      return response()->download($file, $filename, $headers);
    }

    /**
    *
    *
    * @return \Illuminate\Http\Response
    */
    public function downloadEv(Request $request){
      $user = Auth::user();
      $data = FilesEvaluation::find($request->file_id);
      $file = $data->path;
      $ext  = substr(strrchr($file,'.'),1);
      $mime = mime_content_type ($file);
      $headers = array(
        'Content-Type: '.$mime,
      );

      $filename = $data->name.".".$ext;
      return response()->download($file, $filename, $headers);
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

    protected function evaluateDiagnosticP2($evaluation){
      $answer_4_ponderation = 0;
      $value_q_4 = 20/2;
      $answer_5_ponderation = 0;
      $value_q_5 = 20/3;
      //evaluate q5
      if($evaluation->answer_q5_1){
        $answer_5_ponderation = $answer_5_ponderation+$value_q_5;
      }
      if($evaluation->answer_q5_2){
        $answer_5_ponderation = $answer_5_ponderation+$value_q_5;
      }
      if($evaluation->answer_q5_3){
        $answer_5_ponderation = $answer_5_ponderation+$value_q_5;
      }
      $evaluation->answer_ponderation_5 = $answer_5_ponderation;
      //evaluate q4
      if($evaluation->answer_q4_1){
        $answer_4_ponderation = $answer_4_ponderation+$value_q_4;
      }
      if($evaluation->answer_q4_2){
        $answer_4_ponderation = $answer_4_ponderation+$value_q_4;
      }
      $evaluation->answer_ponderation_4 = $answer_4_ponderation;
      $evaluation->total_score = $evaluation->total_score + $answer_4_ponderation+$answer_5_ponderation;
      $evaluation->save();
      return true;

    }

    /**
     * Muestra lista de respuestas de diagnostico general
     *
     * @return \Illuminate\Http\Response
     */
    public function viewEvaluation($score_id)
    {
      $user      = Auth::user();
      $score     = FellowScore::where('id',$score_id)->firstOrFail();
      $userf     = User::find($score->user_id);
      return view('admin.evaluations.evaluation-view')->with([
        "user"      => $user,
        "score"   => $score,
        "userf"      => $userf,
      ]);

    }
}
