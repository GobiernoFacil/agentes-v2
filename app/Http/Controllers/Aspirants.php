<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Mail;
//Models
use App\Models\Aspirant;
use App\Models\AspirantsFile;
use App\Models\City;
use App\Models\AspirantEvaluation;
// FormValidators
use App\Http\Requests\SaveEvaluation;
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
      $aspirants = Aspirant::where('is_activated',1)->paginate($this->pageSize);
      return view('admin.aspirants.aspirant-list')->with([
        'user' => $user,
        'aspirants' =>$aspirants
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
        return view('admin.aspirants.aspirant-view')->with([
          'user' => $user,
          'aspirant' =>$aspirant
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
      return view('admin.aspirants.aspirant-evaluation')->with([
        'user' => $user,
        'aspirant' =>$aspirant
      ]);
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
      $evaluation = new AspirantEvaluation($request->except('_token'));
      $evaluation->user_id   = $user->id;
      $evaluation->experience = current(array_slice($request->experience, 0, 1));
      $evaluation->experience1 = current(array_slice($request->experience1, 0, 1));
      $evaluation->experience2 = current(array_slice($request->experience2, 0, 1));
      $evaluation->experience3 = current(array_slice($request->experience3, 0, 1));
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

}
