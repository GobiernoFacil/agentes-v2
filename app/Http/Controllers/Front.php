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
      }else{
        return redirect('/');
      }

      $mime = mime_content_type ($path);
      $headers = array(
        'Content-Type: '.$mime,
      );
      return response()->download($path, $name, $headers);
    }

}
