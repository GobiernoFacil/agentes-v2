<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\Notice;
use App\Models\Aspirant;
use App\Models\AspirantEvaluation;
use App\Models\AspirantsFile;
use App\Models\AspirantInstitution;
use App\Models\AspirantGlobalGrade;
use PDF;
use App\Http\Requests\SaveAspirantEvaluation1;
use App\Http\Requests\SaveAspirantEvaluation2;
class AdminAspirants extends Controller
{
    //

    /**
     * Muestra lista de convocatorias para acceder a sus aspirantes
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $user    = Auth::user();
        $notices = Notice::orderBy('start','desc')->get();
        return view('admin.aspirants.notices-list')->with([
          'user'    => $user,
          'notices' => $notices
        ]);
    }

    /**
     * Muestra aspirantes de convocatoria
     *
     * @return \Illuminate\Http\Response
     */
    public function aspirantList($notice_id)
    {
        //
        $user      = Auth::user();
        $notice    = Notice::where('id',$notice_id)->firstOrFail();
        $list      = $notice->all_aspirants_data()->orderBy('name','asc')->paginate();
        $aWp_count = $notice->aspirants_without_data()->count();
        $aWpE_count = $notice->aspirants_without_proof_evaluation()->count();
        $aRp_count  = $notice->aspirants_rejected_proof()->count();
        $aAe_count  = $notice->aspirants_already_evaluated()->count();
        $aspirants = $notice->all_aspirants_data()->get();
        $type_list     = 0;
        return view('admin.aspirants.aspirant-list')->with([
          'user' =>$user,
          'notice' => $notice,
          'aspirants' =>$aspirants,
          'list' =>$list,
          'type_list' => $type_list,
          'aWp_count' => $aWp_count,
          'aWpE_count'=> $aWpE_count,
          'aRp_count' => $aRp_count,
          'aAe_count' => $aAe_count
        ]);

    }

    /**
     * Muestra aspirantes de convocatoria sin comprobante de domicilio
     *
     * @return \Illuminate\Http\Response
     */
    public function aspirantWithOutProof($notice_id)
    {
        //
        $user      = Auth::user();
        $notice    = Notice::where('id',$notice_id)->firstOrFail();
        $list      = $notice->aspirants_without_data()->orderBy('name','asc')->paginate();
        $aWp_count = $notice->aspirants_without_data()->count();
        $aWpE_count = $notice->aspirants_without_proof_evaluation()->count();
        $aRp_count  = $notice->aspirants_rejected_proof()->count();
        $aAe_count  = $notice->aspirants_already_evaluated()->count();
        $aspirants = $notice->all_aspirants_data()->get();
        $type_list     = 1;
        return view('admin.aspirants.aspirant-list')->with([
          'user' =>$user,
          'notice' => $notice,
          'aspirants' =>$aspirants,
          'list' =>$list,
          'type_list' => $type_list,
          'aWp_count' => $aWp_count,
          'aWpE_count'=> $aWpE_count,
          'aRp_count' => $aRp_count,
          'aAe_count' => $aAe_count
        ]);

    }

    /**
     * Muestra aspirantes de convocatoria con comprobante de domicilio valido
     *
     * @return \Illuminate\Http\Response
     */
    public function aspirantRejected($notice_id)
    {
        //
        $user      = Auth::user();
        $notice    = Notice::where('id',$notice_id)->firstOrFail();
        $list      = $notice->aspirants_rejected_proof()->paginate();
        $aWp_count = $notice->aspirants_without_data()->count();
        $aWpE_count = $notice->aspirants_without_proof_evaluation()->count();
        $aRp_count  = $notice->aspirants_rejected_proof()->count();
        $aAe_count  = $notice->aspirants_already_evaluated()->count();
        $aspirants = $notice->all_aspirants_data()->get();
        $type_list     = 2;
        return view('admin.aspirants.aspirant-list')->with([
          'user' =>$user,
          'notice' => $notice,
          'aspirants' =>$aspirants,
          'list' =>$list,
          'type_list' => $type_list,
          'aWp_count' => $aWp_count,
          'aWpE_count'=> $aWpE_count,
          'aRp_count' => $aRp_count,
          'aAe_count' => $aAe_count
        ]);

    }

    /**
     * Muestra aspirantes de convocatoria con comprobante evaluado
     *
     * @return \Illuminate\Http\Response
     */
    public function aspirantAlreadyEvaluated($notice_id)
    {
        //
        $user      = Auth::user();
        $notice    = Notice::where('id',$notice_id)->firstOrFail();
        $list      = $notice->aspirants_already_evaluated()->paginate();
        $aWp_count = $notice->aspirants_without_data()->count();
        $aWpE_count = $notice->aspirants_without_proof_evaluation()->count();
        $aRp_count  = $notice->aspirants_rejected_proof()->count();
        $aAe_count  = $notice->aspirants_already_evaluated()->count();
        $aspirants  = $notice->all_aspirants_data()->get();
        $type_list  = 3;
        return view('admin.aspirants.aspirant-list')->with([
          'user' =>$user,
          'notice' => $notice,
          'aspirants' =>$aspirants,
          'list' =>$list,
          'type_list' => $type_list,
          'aWp_count' => $aWp_count,
          'aWpE_count'=> $aWpE_count,
          'aRp_count' => $aRp_count,
          'aAe_count' => $aAe_count
        ]);

    }

    /**
     * Muestra aspirantes de convocatoria con comprobante por evaluar
     *
     * @return \Illuminate\Http\Response
     */
    public function aspirantToEvaluate($notice_id)
    {
        //
        $user      = Auth::user();
        $notice    = Notice::where('id',$notice_id)->firstOrFail();
        $list      = $notice->aspirants_without_proof_evaluation()->paginate();
        $aWp_count = $notice->aspirants_without_data()->count();
        $aWpE_count = $notice->aspirants_without_proof_evaluation()->count();
        $aRp_count  = $notice->aspirants_rejected_proof()->count();
        $aAe_count  = $notice->aspirants_already_evaluated()->count();
        $aspirants  = $notice->all_aspirants_data()->get();
        $type_list  = 4;
        return view('admin.aspirants.aspirant-list')->with([
          'user' =>$user,
          'notice' => $notice,
          'aspirants' =>$aspirants,
          'list' =>$list,
          'type_list' => $type_list,
          'aWp_count' => $aWp_count,
          'aWpE_count'=> $aWpE_count,
          'aRp_count' => $aRp_count,
          'aAe_count' => $aAe_count
        ]);

    }





      /**
       * Muestra aspirantes de convocatoria
       *
       * @return \Illuminate\Http\Response
       */
      public function viewAspirant($notice_id,$aspirant_id)
      {
          //
          $user    = Auth::user();
          $notice  = Notice::where('id',$notice_id)->firstOrFail();
          $aspirant = Aspirant::where('id',$aspirant_id)->firstOrFail();
          $aspirantEvaluation = AspirantEvaluation::where('aspirant_id',$aspirant->id)->where('institution',$user->institution)->where('notice_id',$notice_id)->first();
          $allEva             = $aspirant->aspirantEvaluation;

          return view('admin.aspirants.aspirant-view')->with([
              'user'      => $user,
              'notice'    => $notice,
              'aspirant' => $aspirant,
              'aspirantEvaluation' => $aspirantEvaluation,
              'allEva' => $allEva
            ]);
      }

      /**
       * Descarga de pdfs
       *
       * @return \Illuminate\Http\Response
       */
      public function downloadPdf($notice_id,$aspirant_id,$type)
      {

        $notice  = Notice::where('id',$notice_id)->firstOrFail();
        $aspirant = Aspirant::where('id',$aspirant_id)->firstOrFail();
        if($type==="cv"){
          $pdf = PDF::loadView('admin.aspirants.pdf.cv-view', compact(['aspirant']));
          return $pdf->download('cv_'.$aspirant->name.'_'.$aspirant->surname.'_'.$aspirant->lastname.'.pdf');
        }elseif($type ==="motivos"){
          $pdf = PDF::loadView('admin.aspirants.pdf.motives-view', compact(['aspirant']));
          return $pdf->download('exposicion_motivos_'.$aspirant->name.'_'.$aspirant->surname.'_'.$aspirant->lastname.'.pdf');
        }
      }
      /**
       * Descarga comprobante
       *
       * @return \Illuminate\Http\Response
       */
      public function download($notices_id,$name){
        $user = Auth::user();
        $file = public_path(). "/files/".$name;
        $ext  = substr(strrchr($file,'.'),1);
        $mime = mime_content_type ($file);
        $headers = array(
          'Content-Type: '.$mime,
        );
        $filename = "comprobante.".$ext;
        return response()->download($file, $filename, $headers);
      }


      /**
       * Evaluar comprobante de domicilio
       *
       * @return \Illuminate\Http\Response
       */
      public function evaluate($notice_id,$aspirant_id)
      {
          //
          $user    = Auth::user();
          $notice  = Notice::where('id',$notice_id)->firstOrFail();
          $aspirant = Aspirant::where('id',$aspirant_id)->firstOrFail();
          $aspirantEvaluation = AspirantEvaluation::firstOrCreate(['aspirant_id'=>$aspirant->id,'institution'=>$user->institution,'notice_id'=>$notice_id]);

          return view('admin.aspirants.evaluation.aspirant-address-proof')->with([
              'user'      => $user,
              'notice'    => $notice,
              'aspirant' => $aspirant,
              'aspirantEvaluation' => $aspirantEvaluation,
            ]);
      }

      /**
       * Evaluar comprobante de domicilio
       *
       * @return \Illuminate\Http\Response
       */
      public function saveEvaluate(SaveAspirantEvaluation1 $request)
      {
          //
          $user    = Auth::user();
          $notice  = Notice::where('id',$request->notice_id)->firstOrFail();
          $aspirant = Aspirant::where('id',$request->aspirant_id)->firstOrFail();
          $aspirantEvaluation = AspirantEvaluation::firstOrCreate(['aspirant_id'=>$aspirant->id,'institution'=>$user->institution,'notice_id'=> $request->notice_id]);
          $aspirantEvaluation->address_proof = current(array_slice($request->address_proof, 0, 1));
          $aspirantEvaluation->save();
          return redirect("dashboard/aspirantes/convocatoria/$notice->id/aspirantes-con-archivo-por-evaluar");
      }


      /**
       * Muestra aspirantes de convocatoria con aplicacion por evaluar para la institucion del usuario
       *
       * @return \Illuminate\Http\Response
       */
      public function aspirantAppToEvaluate($notice_id)
      {
          //
          $user      = Auth::user();
          $notice    = Notice::where('id',$notice_id)->firstOrFail();
          $aspirants = $notice->all_aspirants_data()->get();
          $list      = $notice->aspirants_per_institution_to_evaluate()->paginate();
          $asToE_count = $notice->aspirants_per_institution_to_evaluate()->count();
          $aAe_count  = $notice->aspirants_app_already_evaluated()->count();
          $aIaE_count = $notice->aspirants_per_institution_evaluated()->count();
          $type_list = 1;
          return view('admin.aspirants.aspirant-list-per-institution')->with([
            'user' =>$user,
            'notice' => $notice,
            'aspirants' =>$aspirants,
            'list' =>$list,
            'type_list' => $type_list,
            'asToE_count' => $asToE_count,
            'aAe_count'  =>$aAe_count,
            'aIaE_count' =>$aIaE_count
          ]);



      }

      /**
       * Muestra aspirantes de convocatoria con aplicacion evaluada para la institucion del usuario
       *
       * @return \Illuminate\Http\Response
       */
      public function aspirantAppAlreadyEvaluated($notice_id)
      {
          //
          $user      = Auth::user();
          $notice    = Notice::where('id',$notice_id)->firstOrFail();
          $aspirants = $notice->all_aspirants_data()->get();
          $list      = $notice->aspirants_per_institution_evaluated()->paginate();
          $asToE_count = $notice->aspirants_per_institution_to_evaluate()->count();
          $aAe_count  = $notice->aspirants_app_already_evaluated()->count();
          $aIaE_count = $notice->aspirants_per_institution_evaluated()->count();
          $type_list = 2;
          return view('admin.aspirants.aspirant-list-per-institution')->with([
            'user' =>$user,
            'notice' => $notice,
            'aspirants' =>$aspirants,
            'list' =>$list,
            'type_list' => $type_list,
            'asToE_count' => $asToE_count,
            'aAe_count'  =>$aAe_count,
            'aIaE_count' =>$aIaE_count
          ]);


      }

      /**
       * Muestra todos los aspirantes de convocatoria con aplicacion evaluada
       *
       * @return \Illuminate\Http\Response
       */
      public function allAspirantAppAlreadyEvaluated($notice_id)
      {
          //
          $user      = Auth::user();
          $notice    = Notice::where('id',$notice_id)->firstOrFail();
          $aspirants = $notice->all_aspirants_data()->get();
          $list      = $notice->aspirants_app_already_evaluated()->paginate();
          $asToE_count = $notice->aspirants_per_institution_to_evaluate()->count();
          $aAe_count  = $notice->aspirants_app_already_evaluated()->count();
          $aIaE_count = $notice->aspirants_per_institution_evaluated()->count();
          $type_list = 0;
          return view('admin.aspirants.aspirant-list-per-institution')->with([
            'user' =>$user,
            'notice' => $notice,
            'aspirants' =>$aspirants,
            'list' =>$list,
            'type_list' => $type_list,
            'asToE_count' => $asToE_count,
            'aAe_count'  =>$aAe_count,
            'aIaE_count' =>$aIaE_count
          ]);


      }

      /**
       * Muestra formulario para evaluar a aspirante
       *
       * @return \Illuminate\Http\Response
       */
      public function evaluateData($notice_id, $aspirant_id)
      {
          //
          $user      = Auth::user();
          $notice    = Notice::where('id',$notice_id)->firstOrFail();
          $aspirant  = Aspirant::where('id',$aspirant_id)->firstOrFail();
          $ev        = $aspirant->aspirantEvaluation->where('institution',$user->institution)->first();
          return view('admin.aspirants.evaluation.aspirant-evaluation')->with([
            'user' =>$user,
            'notice' => $notice,
            'aspirant' =>$aspirant,
            'ev' => $ev
          ]);


      }




      /**
       * Muestra formulario para evaluar a aspirante
       *
       * @return \Illuminate\Http\Response
       */
      public function saveEvaluateData(SaveAspirantEvaluation2 $request)
      {
          //
          $user      = Auth::user();
          $notice    = Notice::where('id',$request->notice_id)->firstOrFail();
          $aspirant  = Aspirant::where('id',$request->aspirant_id)->firstOrFail();
          $ev        = AspirantEvaluation::firstOrCreate(['aspirant_id'=>$request->aspirant_id,
                                                          'notice_id'=>$request->notice_id,
                                                          'institution'=>$user->institution]);
          $ev->grade  = ($request->essayGrade + $request->videoGrade + $request->experienceGrade)/3;
          $ev->save();
          $data       = $request->except(['_token']);
          AspirantEvaluation::where('id',$ev->id)->update($data);
          $this->updateGrade($aspirant,$notice);
          return redirect("dashboard/aspirantes/convocatoria/$notice->id/aspirantes-con-aplicacion-por-evaluar")->with(['message'=>'Se ha guardado correctamente']);

      }

      /**
       * funcion para actualizar calificaciones globales
       *
       *
       */
       function updateGrade($aspirant,$notice){
         $allGrades = AspirantEvaluation::whereNotNull('grade')->where('notice_id',$notice->id)->where('aspirant_id',$aspirant->id)->get();
         $grade     = $allGrades->sum('grade')/$allGrades->count();
         $global    = AspirantGlobalGrade::firstOrCreate(['notice_id'=>$notice->id,'aspirant_id'=>$aspirant->id]);
         $global->grade = $grade;
         $global->save();
         return true;
       }


}
