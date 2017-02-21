<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NoticeFront extends Controller
{
  /******************* funciones de convocatoria ************************/
      //convocatoria
      public function convocatoria(){
        return view('welcome');
      }

      //convocatoria/bases
      public function bases(){
        return view('welcome');
      }

      //convocatoria/aplicar
      public function aplicar(){
        return view('frontend.convocatoria.aplicar-1');
      }

      //convocatoria/resultados
      public function resultados(){
        return view('welcome');
      }

}
