<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Mail;
//Models
use App\User;
use App\Models\Module;
use App\Models\Aspirant;
use App\Models\AspirantsFile;
use App\Models\FileEvaluation;
use App\Models\City;
use App\Models\AspirantEvaluation;
use App\Models\Institution;
use App\Models\FellowScore;
use App\Models\QuizInfo;
use App\Models\FilesEvaluation;
use App\Models\Activity;
use App\Models\Program;
// FormValidators
use App\Http\Requests\SaveEvaluation;
use App\Http\Requests\SaveFilesEvaluation;

class FellowsAdmin extends Controller
{

  //Paginación
  public $pageSize = 10;

      /**
       * Lista de programas
       *
       * @return \Illuminate\Http\Response
       */
      public function indexProgram()
      {
        $user = Auth::user();
        $programs = Program::orderBy('start','asc')->paginate();
        return view('admin.fellows.fellows-program-list')->with([
          'user' 		=> $user,
          'programs'=>$programs
        ]);
      }
    /**
     * Lista de fellows por programa
     *
     * @return \Illuminate\Http\Response
     */
    public function index($program_id)
    {

      $user = Auth::user();
      $program = Program::where('id',$program_id)->firstOrFail();
      $testUserId = User::where('email','andre@fcb.com')->pluck('id')->toArray();
      $fellows    = $program->get_all_fellows()->whereNotIn('id',$testUserId)->orderBy('name','asc')->paginate($this->pageSize);
      return view('admin.fellows.fellows-list')->with([
        'user' 		=> $user,
        'fellows' 	=>$fellows,
        'program' => $program
      ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function view($program_id,$fellow_id)
    {
        //
        $user = Auth::user();
        $program = Program::where('id',$program_id)->firstOrFail();
        $fellow  = $program->fellows()->where('user_id',$fellow_id)->first();
        $fellow  = User::where('id',$fellow->user_id)->where('type','fellow')->where('enabled',1)->firstOrFail();

        return view('admin.fellows.fellow-view')->with([
          'user' 	=> $user,
          'fellow' 	=> $fellow,
          'program' => $program
        ]);
    }

    /**
     * Search aspirant
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
     public function search(Request $request){
         $member = $request->match;
         $results = Aspirant::where('name', 'like', "$member%")
                    ->where('is_activated',1)
                    ->orwhere('surname','like',"$member%")
                    ->orwhere('lastname','like',"$member%")
                    ->orwhere('email','like',"$member%")
                    ->orwhere('state','like',"$member%")
                    ->orwhere('city','like',"$member%")
                    ->get();
         if($results->isempty()){
          return response()->json(['false'])->header('Access-Control-Allow-Origin', '*');;
         }else{
           return response()->json($results)->header('Access-Control-Allow-Origin', '*');
         }


     }


     /**
      * Display the evaluations sheet
      *
      * @param  int  $id
      * @return \Illuminate\Http\Response
      */
     public function viewSheet($program_id,$fellow_id)
     {
         $user     = Auth::user();
         $program = Program::where('id',$program_id)->firstOrFail();
         $fellow  = $program->fellows()->where('user_id',$fellow_id)->first();
         $fellow  = User::where('id',$fellow->user_id)->where('type','fellow')->where('enabled',1)->firstOrFail();
         $modules  = $program->modules()->paginate(5);
         return view('admin.fellows.evaluation-module-sheet')->with(
          [
            'user'=>$user,
            'modules' =>$modules,
            'fellow'  => $fellow,
            'program' => $program
          ]
         );
     }

     /**
      * Display the evaluations sheet
      *
      * @param  int  $id
      * @return \Illuminate\Http\Response
      */
     public function viewModule($program_id,$module_id,$fellow_id)
     {
         $user     = Auth::user();
         $program  = Program::where('id',$program_id)->firstOrFail();
         $module   = Module::where('id',$module_id)->firstOrFail();
         $fellow   = $program->fellows()->where('user_id',$fellow_id)->first();
         $fellow   = User::where('id',$fellow->user_id)->where('type','fellow')->where('enabled',1)->firstOrFail();
         return view('admin.fellows.fellow-module-view')->with(
          [
            'user'=>$user,
            'module' =>$module,
            'fellow'  => $fellow,
            'program' => $program
          ]
         );
     }

     /**
      * Display the participation sheet
      *
      * @param  int  $id
      * @return \Illuminate\Http\Response
      */
     public function participationSheet($program_id,$fellow_id)
     {
       $user     = Auth::user();
       $program = Program::where('id',$program_id)->firstOrFail();
       $fellow  = $program->fellows()->where('user_id',$fellow_id)->first();
       $fellow  = User::where('id',$fellow->user_id)->where('type','fellow')->where('enabled',1)->firstOrFail();
       $modules = $program->get_modules_with_forums()->paginate(5);
         return view('admin.fellows.participation-sheet')->with(
          [
            'user'=>$user,
            'fellow'  => $fellow,
            'modules' =>$modules,
            'program' => $program
          ]
         );
     }




}
