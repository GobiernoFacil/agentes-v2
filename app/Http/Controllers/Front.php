<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Front extends Controller
{
    //página de inicio
    public function index(){
      return view('welcome');
    }

    //descripcion
    public function descripcion(){
      return view('welcome');
    }

    //objetivos
    public function objetivos(){
      return view('welcome');
    }

    //aliados
    public function aliados(){
      return view('welcome');
    }

    //contacto
    public function contacto(){
      return view('welcome');
    }

    //politicas-de-privacidad
    public function politicas(){
      return view('welcome');
    }

    //redes-sociales
    public function redes(){
      return view('welcome');
    }


}
