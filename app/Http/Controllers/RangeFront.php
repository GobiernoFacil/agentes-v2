<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RangeFront extends Controller
{
  /******************* funciones de alcance ************************/

      //alcance
      public function alcance(){
        return view('frontend.programas.scope-list');
      }
      //alcance por estado
      public function descripcion($state){
        $view_name  = "alcance-".$state;
        return view('frontend.programas.alcance.'.$view_name);
      }

      //conforman ejercicio por estado
      public function conforman($state){
        $view_name  = "conforman.".$state;
        return view($view_name);
      }

      //contexto por estado
      public function contexto($state){
        $view_name  = "contexto.".$state;
        return view($view_name);
      }

      //estatus por estado
      public function estatus($state){
        $view_name  = "estatus.".$state;
        return view($view_name);
      }
}
