<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Front extends Controller
{
    //página de inicio
    public function index(){
      return view('frontend.home');
    }

    //descripcion
    public function descripcion(){
      return view('frontend.programas.que-es');
    }

    //programa 2017
    public function pro17(){
      return view('frontend.programas.2017.que-es');
    }

    //testimonios 2017
    public function testimony17(){
      return view('frontend.programas.2017.testimonio');
    }

    //programa 2018
    public function pro18(){
      return view('frontend.programas.2018.que-es');
    }

    //objetivos
    public function antecedentes(){
      return view('frontend.programas.antecedentes');
    }

    //aliados
    public function aliados(){
      return view('frontend.programas.allies');
    }

    //contacto
    public function contacto(){
      return view('frontend.contacto');
    }

    //politicas-de-privacidad
    public function politicas(){
      return view('frontend.privacidad');
    }

    //redes-sociales
    public function redes(){
      return view('welcome');
    }

    /**
     * Genera descarga pdf
     *
     * @return \Illuminate\Http\Response
     */
    public function download($type)
    {
      if($type==='seminaro-1'){
          $path  = public_path().'/archivos/Programa_Primer_Seminario_Internacional.pdf';
          $name  = 'Programa_Primer_Seminario_Internacional.pdf';
      }elseif($type==='seminaro-2'){
          $path  = public_path().'/archivos/Agenda_2ndoSeminario_Internacional.pdf';
          $name  = 'Agenda_2ndoSeminario_Internacional.pdf';
      }elseif($type==='guia-co'){
        $path  = public_path().'/archivos/guiacocreaciondecompromisos.pdf';
        $name = 'guiacocreaciondecompromisos.pdf';
      }elseif($type==='guia-tl'){
        $path  = public_path().'/archivos/guiastl.pdf';
        $name = 'guiastl.pdf';
      }elseif($type==='taller_diagnostico'){
        $path  = public_path().'/archivos/taller_1_gesoc_diagnostico.pptx';
        $name ='taller_1_gesoc_diagnostico.pptx';
      }else{
        return redirect('/');
      }

      $fileData = pathinfo($path);
      $headers = array(
        'Content-Type: '.$fileData['extension'],
      );
      return response()->download($fileData['dirname'].'/'.$fileData['basename'], $name, $headers);
    }

}
