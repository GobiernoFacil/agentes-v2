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
      $testUserId = User::where('email','andre@fcb.com')->get()->pluck('id');
      $fellows    = $program->get_all_fellows()->paginate($this->pageSize);
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
    public function view($id)
    {
        //
        $user = Auth::user();
        $fellow = User::where('id',$id)->where('type','fellow')->where('enabled',1)->firstOrFail();
        $fellowScores = FellowScore::where('user_id',$fellow->id)->get();
        $fileScores = FilesEvaluation::where('fellow_id',$fellow->id)->get();
        $total = Activity::where('type','evaluation')->count();
        $score  = 0;
        foreach ($fellowScores as $fscore) {
            $score = $score + $fscore->score;
        }
        foreach ($fileScores as $ffscore){
            $score = $score + $ffscore->score;
        }

        if($total!= 0){
          $average = $score/$total;
        }else{
          $average = 0;
        }

        return view('admin.fellows.fellow-view')->with([
          'user' 	=> $user,
          'fellow' 	=> $fellow,
          'average' => $average
        ]);
    }

    public function download($name,$type){
      $user = Auth::user();
      $file = public_path(). "/files/".$name;
      $ext  = substr(strrchr($file,'.'),1);
      $mime = mime_content_type ($file);
      $headers = array(
        'Content-Type: '.$mime,
      );
      if($type =='CV'){
        $filename = 'CV'.".".$ext;
      }else if($type =='carta'){
          $filename = 'carta'.".".$ext;
      }else if($type =='comprobante'){
          $filename = 'comprobante'.".".$ext;
      }else if($type =='privacidad'){
          $filename = 'privacidad'.".".$ext;
      }else{
        $filename = 'Ensayo'.".".$ext;
      }
      return response()->download($file, $filename, $headers);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        //
    }

    /**
     * Get cities
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function cities(Request $request){
      $cities = City::where('state', 'like', $request->input('state') . '%')->orderBy('city', 'asc')->get();
      return response()->json($cities);
    }

    /**
     * Get evaluation view
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function evaluation($id){
      $user = Auth::user();
      $aspirant = Aspirant::find($id);
      $files    = FileEvaluation::where('aspirant_id',$aspirant->id)->first();
      $check    = $this->check($aspirant);
      if(!$check){
        $evaluation  = AspirantEvaluation::firstOrCreate(['aspirant_id'=>$aspirant->id]);
        return view('admin.aspirants.aspirant-error')->with([
          'user' => $user,
          'aspirant' =>$aspirant,
          'evaluation' => $evaluation,
          'files'=>$files
        ]);
      }else{
        $evaluation  = AspirantEvaluation::firstOrCreate(['aspirant_id'=>$aspirant->id,"user_id"=>$user->id]);
        return view('admin.aspirants.aspirant-evaluation')->with([
          'user' => $user,
          'aspirant' =>$aspirant,
          'evaluation' => $evaluation,
          'files'=>$files
        ]);
      }
    }


    /**
     * Get files evaluation view
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function evaluateFiles($id){
      $user = Auth::user();
      $aspirant = Aspirant::find($id);
      $files    = AspirantsFile::where('aspirant_id',$aspirant->id)->first();
      $check    = $this->checkFiles($aspirant);
      if(!$check){
        $filesEva  = FileEvaluation::where(['aspirant_id'=>$aspirant->id,'institution'=>$user->institution])->first();
        return view('admin.aspirants.aspirant-files-error')->with([
          'user' => $user,
          'aspirant' =>$aspirant,
          'files'=>$files,
          'filesEva' => $filesEva
        ]);
      }else{
        $evaluation  = AspirantEvaluation::firstOrCreate(['aspirant_id'=>$aspirant->id,"user_id"=>$user->id]);
        $filesEva    = FileEvaluation::firstOrCreate(['aspirant_id'=>$aspirant->id,"institution"=>$user->institution,'user_id'=>$user->id]);
        return view('admin.aspirants.aspirant-files-evaluation')->with([
          'user' => $user,
          'aspirant' =>$aspirant,
          'evaluation' => $evaluation,
          'files'=>$files,
          'filesEva' =>$filesEva
        ]);
      }
    }

    /**
     * Save file evaluation answers
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function SaveEvaluationFiles(SaveFilesEvaluation $request, $id){
      $user = Auth::user();
      $aspirant = Aspirant::find($id);
      //deletes null evaluation
      $check    = $this->checkFiles($aspirant);
      if(!$check){
        $check    = FileEvaluation::where("aspirant_id", $aspirant->id)->where('institution',$user->institution)->where('user_id','!=',$user->id)->first();
        $check->delete();
      }
      $evaluation = FileEvaluation::firstOrCreate(['aspirant_id'=>$aspirant->id,"institution"=>$user->institution,'user_id'=>$user->id]);
      if($request->hasVideo){
      $evaluation->hasVideo = current(array_slice($request->hasVideo, 0, 1));
      }
      if($request->hasCv){
      $evaluation->hasCv = current(array_slice($request->hasCv, 0, 1));
      }
      if($request->hasEssay){
      $evaluation->hasEssay = current(array_slice($request->hasEssay, 0, 1));
      }
      if($request->hasProof){
      $evaluation->hasProof = current(array_slice($request->hasProof, 0, 1));
      }
      if($request->hasPrivacy){
      $evaluation->hasPrivacy = current(array_slice($request->hasPrivacy, 0, 1));
      }
      if($request->hasLetter){
      $evaluation->hasLetter = current(array_slice($request->hasLetter, 0, 1));
      }
      $evaluation->institution = $user->institution;
      $evaluation->save();
      return redirect('dashboard/aspirantes/evaluar/'.$aspirant->id)->with('success','Evaluación guardada');
    }


    /**
     * Save evaluation answers
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function saveEvaluation(SaveEvaluation $request, $id){
      $user = Auth::user();
      $aspirant = Aspirant::find($id);
      //deletes null evaluation
      $check    = $this->check($aspirant);
      if(!$check){
        $check    = AspirantEvaluation::where("aspirant_id", $aspirant->id)->where('institution',$user->institution)->where('user_id','!=',$user->id)->first();
        $check->delete();
      }
      $evaluation = AspirantEvaluation::firstOrCreate(['aspirant_id'=>$aspirant->id,'user_id'=>$user->id]);
      $evaluation->user_id   = $user->id;
      if($request->experience){
      $evaluation->experience = current(array_slice($request->experience, 0, 1));
      $evaluation->experience1 = current(array_slice($request->experience1, 0, 1));
      $evaluation->experience2 = current(array_slice($request->experience2, 0, 1));
      $evaluation->experience3 = current(array_slice($request->experience3, 0, 1));
      $evaluation->experienceJ1 = $request->experienceJ1;
      $evaluation->experienceJ2 = $request->experienceJ2;
      $evaluation->experienceGrade = $this->experienceGrade($evaluation);
      }
      if($request->essay){
      $evaluation->essay = current(array_slice($request->essay, 0, 1));
      $evaluation->essay1 = current(array_slice($request->essay1, 0, 1));
      $evaluation->essay2 = current(array_slice($request->essay2, 0, 1));
      $evaluation->essay3 = current(array_slice($request->essay3, 0, 1));
      $evaluation->essay4 = current(array_slice($request->essay4, 0, 1));
      $evaluation->essayGrade = $this->essayGrade($evaluation);
      }
      if($request->video){
      $evaluation->video = current(array_slice($request->video, 0, 1));
      $evaluation->video1 = current(array_slice($request->video1, 0, 1));
      $evaluation->video2 = current(array_slice($request->video2, 0, 1));
      $evaluation->video3 = current(array_slice($request->video3, 0, 1));
      $evaluation->video4 = current(array_slice($request->video4, 0, 1));
      $evaluation->videoGrade = $this->videoGrade($evaluation);
      }
      $evaluation->aspirant_id = $aspirant->id;
      $evaluation->institution = $user->institution;
      $evaluation->grade    =   $evaluation->experienceGrade + $evaluation->videoGrade +$evaluation->essayGrade;
      $evaluation->save();
      return redirect('dashboard/aspirantes/ver/'.$aspirant->id)->with('success','Evaluación guardada');


    }

    protected function experienceGrade($data){
      $total = 0;
      if($data->experience){
        $total = $total + .75;
      }
      $total = $total + (($data->experience1*.75)/10);
      if($data->experience2){
        $total = $total + .75;
      }
      $total = $total + (($data->experience3*.75)/10);

      return $total;

    }

    protected function essayGrade($data){
      $total = 0;
      $total = $total + (($data->essay*.7)/10);
      $total = $total + (($data->essay1*.7)/10);
      $total = $total + (($data->essay2*.7)/10);
      $total = $total + (($data->essay3*.7)/10);
      $total = $total + (($data->essay4*.7)/10);

      return $total;

    }

    protected function videoGrade($data){
      $total = 0;
      $total = $total + (($data->video*.7)/10);
      $total = $total + (($data->video1*.7)/10);
      $total = $total + (($data->video2*.7)/10);
      $total = $total + (($data->video3*.7)/10);
      $total = $total + (($data->video4*.7)/10);

      return $total;

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
      * check empty evaluation
      *
      * @param  int  $id
      * @return \Illuminate\Http\Response
      */
     protected function check($aspirant){
       $user     = Auth::user();
       $check    = AspirantEvaluation::where("aspirant_id", $aspirant->id)->where('institution',$user->institution)->where('user_id','!=',$user->id)->first();
       if(!$check){return true;}
       if($check->count()>0){
         //empty evaluation allows to evaluate
         if(!$check->grade){
           return true;
         }else{
           return false;
         }
       }else{
         return true;

       }

     }

     /**
      * check empty files evaluation
      *
      * @param  int  $id
      * @return \Illuminate\Http\Response
      */
     protected function checkFiles($aspirant){
       $user     = Auth::user();
       $check    = FileEvaluation::where("aspirant_id", $aspirant->id)->where('institution',$user->institution)->first();
       if(!$check){return true;}
       if($check->count()>0){
         //empty evaluation allows to evaluate
         if(!$check->hasVideo){
           return true;
         }else{
           return false;
         }
       }else{
         return true;

       }

     }

     /**
      * Display the evaluations sheet
      *
      * @param  int  $id
      * @return \Illuminate\Http\Response
      */
     public function viewSheet($id)
     {
         $user     = Auth::user();
         $fellow   = User::find($id);
         $modules  = Module::orderBy('start','asc')->get();
         $fellowScores = FellowScore::where('user_id',$fellow->id)->get();
         $fileScores = FilesEvaluation::where('fellow_id',$fellow->id)->get();
         $total = Activity::where('type','evaluation')->count();
         $score  = 0;
         foreach ($fellowScores as $fscore) {
             $score = $score + $fscore->score;
         }
         foreach ($fileScores as $ffscore){
             $score = $score + $ffscore->score;
         }

         if($total!= 0){
           $average = $score/$total;
         }else{
           $average = 0;
         }
         return view('admin.fellows.evaluation-sheet')->with(
          [
            'user'=>$user,
            'modules' =>$modules,
            'average' => $average,
            'fellow'  => $fellow
          ]
         );
     }

     /**
      * Display the participation sheet
      *
      * @param  int  $id
      * @return \Illuminate\Http\Response
      */
     public function participationSheet($id)
     {
         $user     = Auth::user();
         $fellow   = User::find($id);
         $modules  = Module::orderBy('start','asc')->paginate($this->pageSize);;
         return view('admin.fellows.participation-sheet')->with(
          [
            'user'=>$user,
            'fellow'  => $fellow,
            'modules' =>$modules
          ]
         );
     }




}
