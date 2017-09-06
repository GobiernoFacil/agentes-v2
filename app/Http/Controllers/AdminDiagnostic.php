<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\CustomQuestionnaire;
use App\Models\CustomFellowAnswer;
class AdminDiagnostic extends Controller
{
    //


        /**
         * Ver pruebas diagnostico
         *
         * @return \Illuminate\Http\Response
         */
        public function index()
        {
            //
            $user            = Auth::user();
            $questionnaires  = CustomQuestionnaire::orderBy('created_at','desc')->get();
            return view('admin.diagnostic.all-list')->with([
              "user"      => $user,
              "questionnaires" => $questionnaires
            ]);
        }

        /**
         * Ver pruebas diagnostico
         *
         * @return \Illuminate\Http\Response
         */
        public function getCustom($id)
        {
            //
            $user            = Auth::user();
            $questionnaire  = CustomQuestionnaire::where('id',$id)->firstOrFail();
            return view('admin.diagnostic.custom-view')->with([
              "user"      => $user,
              "questionnaire" => $questionnaire
            ]);
        }

        /**
         * descargar
         *
         * @return \Illuminate\Http\Response
         */
        public function download($type,$id)
        {
            //
             $path = base_path().'/csv/reports/cuestionario_diagnostico_'.$id;
             $name = 'cuestionario_diagnostico_'.$id;
            if($type==='pdf'){
              $file = $path.'.pdf';
              $mime = mime_content_type ($file);
              $headers = array(
                'Content-Type: '.$mime,
              );
              return response()->download($file, $name.'.pdf', $headers);
            }elseif($type==='xlsx'){
              $file = $path.'.xlsx';
              $mime = mime_content_type ($file);
              $headers = array(
                'Content-Type: '.$mime,
              );
              return response()->download($file, $name.'.xlsx', $headers);
            }

        }
}
