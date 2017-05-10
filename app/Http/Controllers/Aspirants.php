<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Mail;
//Models
use App\Models\Aspirant;
use App\Models\AspirantsFile;
use App\Models\FileEvaluation;
use App\Models\City;
use App\Models\AspirantEvaluation;
use App\Models\Institution;
// FormValidators
use App\Http\Requests\SaveEvaluation;
use App\Http\Requests\SaveFilesEvaluation;
class Aspirants extends Controller
{

  //Paginación
  public $pageSize = 10;
    /**
     * Lista de aspirantes
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $user = Auth::user();
      $aspirants_filesId  = AspirantsFile::all()->pluck('aspirant_id');
      $aspirants   = Aspirant::where('is_activated',1)->whereIn('id',$aspirants_filesId->toArray())->orderBy('created_at','asc')->paginate($this->pageSize);
      $aspirantsNo = Aspirant::where('is_activated',1)->whereNotIn('id',$aspirants_filesId->toArray())->orderBy('created_at','asc')->paginate($this->pageSize);
      $aspirants_validated = FileEvaluation::distinct('aspirant_id')->pluck('aspirant_id');
      $list_validated = Aspirant::where('is_activated',1)->whereIn('id',$aspirants_validated->toArray())->orderBy('created_at','asc')->paginate($this->pageSize);
      return view('admin.aspirants.aspirant-list')->with([
        'user' => $user,
        'aspirants' =>$aspirants,
        'aspirantsNo' =>$aspirantsNo,
        'listA'      =>$list_validated
      ]);
    }



    /**
     * Lista de aspirantes
     *
     * @return \Illuminate\Http\Response
     */
    public function verify()
    {
      $user = Auth::user();
      $aspirants_validated = FileEvaluation::distinct('aspirant_id')->pluck('aspirant_id');
      $aspirants_filesId  = AspirantsFile::whereNotIn('aspirant_id',$aspirants_validated->toArray())->pluck('aspirant_id');
      $list_no_validated  = Aspirant::where('is_activated',1)->whereIn('id',$aspirants_filesId->toArray())->orderBy('created_at','asc')->paginate($this->pageSize);
      $list_no_validated_count  = Aspirant::where('is_activated',1)->whereIn('id',$aspirants_filesId->toArray())->orderBy('created_at','asc')->get()->count();
      $list_validated_count = Aspirant::where('is_activated',1)->whereIn('id',$aspirants_validated->toArray())->orderBy('created_at','asc')->get()->count();
      $list_validated = Aspirant::where('is_activated',1)->whereIn('id',$aspirants_validated->toArray())->orderBy('created_at','asc')->paginate($this->pageSize);
      return view('admin.aspirants.aspirant-verified-list')->with([
        'user' 						=> $user,
        'listA'     				=>$list_validated,
        'list_validated_count' 		=> $list_validated_count,
        'list_no_validated_count'	=>$list_no_validated_count
      ]);
    }

    /**
     * Lista de aspirantes
     *
     * @return \Illuminate\Http\Response
     */
    public function noVerify()
    {
      $user = Auth::user();
      $aspirants_validated = FileEvaluation::distinct('aspirant_id')->pluck('aspirant_id');
      $aspirants_filesId  = AspirantsFile::whereNotIn('aspirant_id',$aspirants_validated->toArray())->pluck('aspirant_id');
      $list_no_validated  = Aspirant::where('is_activated',1)->whereIn('id',$aspirants_filesId->toArray())->orderBy('created_at','asc')->paginate($this->pageSize);
      return view('admin.aspirants.aspirant-NoVerified-list')->with([
        'user' => $user,
        'listB'      =>$list_no_validated
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
        $aspirant = Aspirant::find($id);
        $aspirantEvaluation = aspirantEvaluation::where('aspirant_id',$aspirant->id)->where('institution',$user->institution)->first();
        $allEva             = $aspirant->aspirantEvaluation;
        $generalGrade = 0;
        if($allEva->count()>0){
          foreach ($allEva as $eva) {
            $generalGrade = $eva->grade + $generalGrade;
          }
          $generalGrade = ($generalGrade)*10;
        }
        return view('admin.aspirants.aspirant-view')->with([
          'user' => $user,
          'aspirant' =>$aspirant,
          'aspirantEvaluation'=>$aspirantEvaluation,
          'allEva' => $allEva,
          'generalGrade' => $generalGrade
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
      $evaluation->hasVideo = current(array_slice($request->hasVideo, 0, 1));
      $evaluation->hasCv = current(array_slice($request->hasCv, 0, 1));
      $evaluation->hasEssay = current(array_slice($request->hasEssay, 0, 1));
      $evaluation->hasProof = current(array_slice($request->hasProof, 0, 1));
      $evaluation->hasPrivacy = current(array_slice($request->hasPrivacy, 0, 1));
      $evaluation->hasLetter = current(array_slice($request->hasLetter, 0, 1));
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
      $evaluation->experience = current(array_slice($request->experience, 0, 1));
      $evaluation->experience1 = current(array_slice($request->experience1, 0, 1));
      $evaluation->experience2 = current(array_slice($request->experience2, 0, 1));
      $evaluation->experience3 = current(array_slice($request->experience3, 0, 1));
      $evaluation->experienceJ1 = $request->experienceJ1;
      $evaluation->experienceJ2 = $request->experienceJ2;
      $evaluation->experienceGrade = $this->experienceGrade($evaluation);
      $evaluation->essay = current(array_slice($request->essay, 0, 1));
      $evaluation->essay1 = current(array_slice($request->essay1, 0, 1));
      $evaluation->essay2 = current(array_slice($request->essay2, 0, 1));
      $evaluation->essay3 = current(array_slice($request->essay3, 0, 1));
      $evaluation->essay4 = current(array_slice($request->essay4, 0, 1));
      $evaluation->essayGrade = $this->essayGrade($evaluation);
      $evaluation->video = current(array_slice($request->video, 0, 1));
      $evaluation->video1 = current(array_slice($request->video1, 0, 1));
      $evaluation->video2 = current(array_slice($request->video2, 0, 1));
      $evaluation->video3 = current(array_slice($request->video3, 0, 1));
      $evaluation->video4 = current(array_slice($request->video4, 0, 1));
      $evaluation->videoGrade = $this->videoGrade($evaluation);
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

}
