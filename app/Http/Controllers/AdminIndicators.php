<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Excel;
use App\Models\Module;
use App\Models\FacilitatorSurver;
class AdminIndicators extends Controller
{
    //

    /**
     * Muestra lista para descargar indicadores
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $user       = Auth::user();
      return view('admin.indicators.indicators-list')->with([
        "user"      => $user,
      ]);

    }


    /**
     * Genera excel con indicadores de facilitadores
     *
     * @return \Illuminate\Http\Response
     */
    public function downloadFacilitators()
    {
      $module  = Module::where('title','CURSO 1 - Gobierno Abierto y los ODS')->first();
      Excel::create('indicadores_facilitadores', function($excel) use($module){
        // Set the title
        $excel->setTitle('Indicadores de percepción positiva de facilitadores');
        // Chain the setters
        $excel->setCreator('Gobierno Fácil')
              ->setCompany('Gobierno Fácil');
        // Call them separately
        $excel->setDescription('Proporción de facilitadores evaluados favorablemete por parte de los agentes de cambio');
        $excel->sheet('Curso 1', function($sheet)use($module){
          $sheet->row(1, [$module->title,'','']);
          $sheet->row(1, function($row) {
            $row->setBackground('#000000');
            $row->setFontColor('#ffffff');
          });
          $sheet->row(2, ['Sesión','Facilitador','Percepción positiva']);
          $sheet->row(2, function($row) {
            $row->setBackground('#000000');
            $row->setFontColor('#ffffff');
          });
          foreach ($module->sessions as $session) {
            foreach($session->facilitators as $facilitator){
             if($facilitator->user->email != 'contacto@prosociedad.org') {
                $sheet->appendRow([$session->name,$facilitator->user->name]);
              }
            }
          }
        });

    })->download('xlsx');

    }



    /**
     * Genera excel con indicadores de fellows
     *
     * @return \Illuminate\Http\Response
     */
    public function downloadFellows()
    {

    }


    protected function get_score_session_facilitator($session,$facilitator){

    }
}
