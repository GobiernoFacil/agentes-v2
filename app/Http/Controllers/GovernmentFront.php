<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GovernmentFront extends Controller
{
  /******************* funciones de gobierno abierto ************************/

      //gobierno-abierto
      public function gobierno(){
        return view('frontend.opengovernment.gobierno-abierto');
      }
      //contenido-teorico-del-modelo
      public function contenido(){
        return view('welcome');
      }
      //recursos
      public function recursos(){
        return view('welcome');
      }
      //videos
      public function videos(){
        return view('welcome');
      }
      //lecturas
      public function lecturas(){
        return view('frontend.opengovernment.recursos');
      }
      //ejercicios
      public function ejercicios(){
        return view('welcome');
      }

}
