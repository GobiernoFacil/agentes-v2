<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Notifications\Notifiable;
use Auth;
use File;
// models
use App\Models\Activity;
use App\Models\DiagnosticAnswer;
use App\Models\DiagnosticEvaluation;
use App\Models\FellowFile;
use App\Models\FellowScore;
use App\Models\FilesEvaluation;
use App\Models\FellowAverage;
use App\Models\CustomFellowAnswer;
use App\Models\Program;
use App\Models\RetroLog;
use App\User;
//Notifications
use App\Notifications\SendRetroEmail;
// FormValidators
use App\Http\Requests\AddSingleFileEvaluation;
use App\Http\Requests\SaveDiagnosticEvaluation1;
use App\Http\Requests\SaveDiagnosticEvaluation2;
use App\Http\Requests\SaveFellowFileEvaluation;
class AdminEvaluations extends Controller
{
    //
    const UPLOADS = "archivos/fellows";
    const UPLOADSF = "archivos/fellowsEva";
    //Paginación
    public $pageSize = 5;
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
    public function index($program_id)
    {
      $user       = Auth::user();
      $program    = Program::where('id',$program_id)->firstOrFail();
      $modules    = $program->get_fellow_modules_with_ev_act()->paginate($this->pageSize);
      return view('admin.evaluations.module-fellow-list')->with([
        "user"         => $user,
        "program"      => $program,
        "modules"      => $modules
      ]);

    }

    /**
     * Muestra lista de fellows con archivos para evaluar
     *
     * @return \Illuminate\Http\Response
     */
    public function indexActivity($program_id,$activity_id)
    {
      $user       = Auth::user();
      $program    = Program::where('id',$program_id)->firstOrFail();
      $activity   = Activity::where('id',$activity_id)->firstOrFail();
      if($activity->files){
        //ver fellows con archivos
        $fellowsIds = FilesEvaluation::where('activity_id',$activity_id)->whereNotNull('score')->pluck('fellow_id');
        $files      = FellowFile::where('activity_id',$activity->id)->whereNotIn('user_id',$fellowsIds->toArray())->paginate($this->pageSize);
        return view('admin.evaluations.activities-files-list')->with([
          "user"      => $user,
          "activity"  => $activity,
          "files"     => $files,
          "program"   => $program
        ]);
      }else{
        //ver fellows con examen automatico
        if(!$activity->quizInfo){
          return redirect('dashboard');
        }
        $scores  = FellowScore::where('questionInfo_id',$activity->quizInfo->id)->paginate($this->pageSize);
        return view('admin.evaluations.activities-fellows-list')->with([
          "user"      => $user,
          "activity"  => $activity,
          "scores"    => $scores,
          "program"   => $program
        ]);
      }


    }


    /**
     * Muestra lista de fellows con archivos para evaluar
     *
     * @return \Illuminate\Http\Response
     */
    public function indexDiagnostic($program_id,$activity_id)
    {
      $user       = Auth::user();
      $program    = Program::where('id',$program_id)->firstOrFail();
      $activity   = Activity::where('type','diagnostic')->where('id',$activity_id)->firstOrFail();
      if($activity->files){
        //ver fellows con archivos
        $fellowsIds = FilesEvaluation::where('activity_id',$activity_id)->pluck('fellow_id');
        $fellows    = FellowFile::where('activity_id',$activity->id)->whereNotIn('user_id',$fellowsIds->toArray())->paginate($this->pageSize);
        return view('admin.evaluations.diagnostic-files-list')->with([
          "user"      => $user,
          "activity"   => $activity,
          "fellows"   =>$fellows,
          "program"   => $program
        ]);
      }else{
        //ver fellows con examen automatico
        if(!$activity->diagnostic_info){
          return redirect("dashboard/programas/$program->id/ver-evaluaciones");
        }
        $fellowsAnswers = CustomFellowAnswer::where('questionnaire_id',$activity->diagnostic_info->id)->pluck('user_id')->toArray();
        $fellows  = $program->fellows()->whereIn('user_id',$fellowsAnswers)->where('user_id','!=',23)->paginate(10);


        return view('admin.evaluations.diagnostic-fellows-list')->with([
          "user"      => $user,
          "activity"  => $activity,
          "fellows"    => $fellows,
          "program"   => $program
        ]);
      }


    }

    /**
     * Muestra lista de respuestas de diagnostico general
     *
     * @return \Illuminate\Http\Response
     */
    public function viewEvaluation($program_id,$activity_id,$score_id)
    {
      $user      = Auth::user();
      $score     = FellowScore::where('id',$score_id)->firstOrFail();
      $userf     = User::find($score->user->id);
      $program    = Program::where('id',$program_id)->firstOrFail();
      $activity   = Activity::where('id',$activity_id)->firstOrFail();
      return view('admin.evaluations.evaluation-view')->with([
        "user"      => $user,
        "score"     => $score,
        "userf"     => $userf,
        "program"   => $program,
        "activity"  => $activity
      ]);

    }


    /**
     * Muestra lista de respuestas de diagnostico general
     *
     * @return \Illuminate\Http\Response
     */
    public function viewDiagnostic($program_id,$activity_id,$user_id)
    {
      $user       = Auth::user();
      $program    = Program::where('id',$program_id)->firstOrFail();
      $activity   = Activity::where('id',$activity_id)->firstOrFail();
      $fellow     = User::where('id',$user_id)->firstOrFail();
      $answers    = $fellow->new_diagnostic($activity->diagnostic_info->id)->get();
      return view('admin.evaluations.diagnostic-fellow-view')->with([
        "user"      => $user,
        "answers"   => $answers,
        "fellow"    => $fellow,
        "program"   => $program,
        "activity"  => $activity
      ]);

    }

    /**
     * Muestra lista de fellow evaluados para la actividad tipo trabajo
     *
     * @return \Illuminate\Http\Response
     */
    public function viewEvaluations($program_id,$activity_id)
    {
      $user       = Auth::user();
      $program    = Program::where('id',$program_id)->firstOrFail();
      $activity   = Activity::where('files',1)->where('id',$activity_id)->firstOrFail();
      //ver fellows con archivos
      $fellows_ids = FilesEvaluation::where('activity_id',$activity_id)->whereNotNull('score')->pluck('fellow_id');
      $fellows     = $program->get_all_fellows()->paginate($this->pageSize);
      return view('admin.evaluations.activities-files-done-list')->with([
          "user"      => $user,
          "activity"  => $activity,
          "fellows"   => $fellows,
          "program"   => $program
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
     * Muestra campos para evaluar archivo
     *
     * @return \Illuminate\Http\Response
     */
    public function fileEvaluation($file_id,$eva=null)
    {
      $user      = Auth::user();
      if($eva){
        //file_id es id de FilesEvaluation
        $data = null;
        $fellow    = FilesEvaluation::find($file_id);
        var_dump($fellow->user->toArray());
      }else{
        $data      = FellowFile::where('id',$file_id)->first();
        $fellow    = FilesEvaluation::firstOrCreate(['fellow_id'=>$data->user_id,'activity_id'=>$data->activity_id]);
      }
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
      $path  = public_path(self::UPLOADSF);
      if($request->eva){
        //file_id es FilesEvaluation id
        $eva = FilesEvaluation::where('id',$request->file_id)->firstOrFail();
        $eva->user_id = $user->id;
      }else{
        $data = FellowFile::where('id',$request->file_id)->firstOrFail();
        $eva  = FilesEvaluation::where('fellow_id',$data->user_id)->where('activity_id',$data->activity_id)->first();
      }
      $eva->user_id = $user->id;
      $eva->url     = $request->url;
      $eva->score     = $request->score;
      $eva->comments = $request->comments;
      // [ SAVE THE file ]
      if($request->hasFile('file_e') && $request->file('file_e')->isValid()){
        if($eva->path){
          File::delete($eva->path);
        }
        $name = uniqid() . '.' . $request->file('file_e')->getClientOriginalExtension();
        $request->file('file_e')->move($path, $name);
        $eva->name = $request->file('file_e')->getClientOriginalName();
        $eva->path = $path.'/'.$name;
      }
      $eva->save();
      $fellowAverage = new FellowAverage();
      $fellowAverage->scoreSession($eva->activity_id,$eva->fellow_id);
      $retro   = RetroLog::firstOrCreate(['user_id'=>$eva->fellow_id,'activity_id'=>$eva->activity_id]);
      $retro->status = 0;
      $retro->save();
      $fellow = User::find($eva->fellow_id);
      $fellow->notify(new SendRetroEmail($fellow,$data->activity));
      return redirect("dashboard/evaluacion/actividad/ver/{$eva->activity_id}")->with('message','Se ha guarado correctamente');
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
      $fileData = pathinfo($file);
      $headers = array(
        'Content-Type: '.$fileData['extension'],
      );
      $filename = $data->name;
      return response()->download($fileData['dirname'].'/'.$fileData['basename'], $filename, $headers);
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
     * Muestra evaluacion de archivos
     *
     * @return \Illuminate\Http\Response
     */
    public function viewFileEvaluation($score_id)
    {
      $user      = Auth::user();
      $score     = FilesEvaluation::where('id',$score_id)->firstOrFail();
      $userf     = User::find($score->user_id);
      return view('admin.evaluations.evaluation-file-view')->with([
        "user"      => $user,
        "score"   => $score,
        "userf"      => $userf,
      ]);

    }
    /**
     * Agregar calificacion manual de archivo (sin archivo)
     *
     * @return \Illuminate\Http\Response
     */
    public function addSingle($program_id,$activity_id)
    {
      $user      = Auth::user();
      $program    = Program::where('id',$program_id)->firstOrFail();
      $activity   = Activity::where('files',1)->where('id',$activity_id)->firstOrFail();
      //usuarios sin archivos
      $fellows_id   = FilesEvaluation::where('activity_id',$activity_id)->pluck('fellow_id');

      $fellows      = $program->get_all_fellows()->whereNotIn('id',$fellows_id->toArray())->orderBy('name','asc')->get();
      $data = [];
      foreach ($fellows as $fellow) {
        $data[$fellow->id] = $fellow->name.' '.$fellow->fellowData->surname.' '.$fellow->fellowData->lastname;
      }
      $fellows = $data;
      $fellows[null] = 'Selecciona un fellow';
      return view('admin.evaluations.file-single-evaluation')->with([
        "user"      => $user,
        "activity"  => $activity,
        "fellows"   => $fellows,
        "program"   => $program
      ]);

    }

    /**
     * Agregar calificacion manual de archivo (sin archivo)
     *
     * @return \Illuminate\Http\Response
     */
    public function saveSingle(AddSingleFileEvaluation $request)
    {
      $user      = Auth::user();
      $eva  = FilesEvaluation::firstOrCreate(['fellow_id'=>$request->fellow_id,'activity_id'=>$request->activity_id]);
      $eva->user_id  = $user->id;
      $eva->url     = $request->url;
      $eva->score     = $request->score;
      $eva->comments = $request->comments;
      $path  = public_path(self::UPLOADSF);
      // [ SAVE THE file ]
      if($request->hasFile('file_e') && $request->file('file_e')->isValid()){
        if($eva->path){
          File::delete($eva->path);
        }
        $name = uniqid() . '.' . $request->file('file_e')->getClientOriginalExtension();
        $request->file('file_e')->move($path, $name);
        $eva->name = $request->file('file_e')->getClientOriginalName();
        $eva->path = $path.'/'.$name;
      }
      $eva->save();
      $fellowAverage = new FellowAverage();
      $fellowAverage->scoreSession($request->activity_id,$request->fellow_id);
      $retro   = RetroLog::firstOrCreate(['user_id'=>$request->fellow_id,'activity_id'=>$request->activity_id]);
      $retro->status = 0;
      $retro->save();
      $fellow = User::find($request->fellow_id);
      $activity = Activity::find($request->activity_id);
      $fellow->notify(new SendRetroEmail($fellow,$activity));
      return redirect("dashboard/programas/$program->id/ver-evaluacion/$request->activity_id")->with('message','Se ha guarado correctamente');

    }




}
