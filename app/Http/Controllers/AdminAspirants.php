<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\Notice;
use App\Models\Aspirant;
use App\Models\AspirantEvaluation;
use PDF;
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
        $user    = Auth::user();
        $notice  = Notice::where('id',$notice_id)->firstOrFail();
        $aspirants_ids = $notice->aspirants()->pluck('aspirant_id');
        $aspirants = Aspirant::whereIn('id',$aspirants_ids->toArray())->paginate();
        return view('admin.aspirants.aspirant-list')->with([
            'user'      => $user,
            'notice'    => $notice,
            'aspirants' => $aspirants
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
          $generalGrade = 0;
          if($allEva->count()>0){
            foreach ($allEva as $eva) {
              $generalGrade = $eva->grade + $generalGrade;
            }
            $generalGrade = ($generalGrade/2)*10;
          }
          return view('admin.aspirants.aspirant-view')->with([
              'user'      => $user,
              'notice'    => $notice,
              'aspirant' => $aspirant,
              'aspirantEvaluation' => $aspirantEvaluation,
              'allEva' => $allEva,
              'generalGrade' => $generalGrade
            ]);
      }

      /**
       * Muestra aspirantes de convocatoria
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






}
