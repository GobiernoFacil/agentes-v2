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


}
