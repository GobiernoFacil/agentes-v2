<?php

namespace App\Http\Controllers;
use Auth;
use Illuminate\Http\Request;

class Suscribe extends Controller
{

  // Redireccionar al dashboard correspondiente después de acceder correctamente
  public function redirectToDashboard(){
    $usuario = Auth::user();
      if($usuario->type ==='superAdmin'){
        return redirect('sa/dashboard');
      }elseif($usuario->type ==='admin'){
        return redirect('dashboard');
      }elseif($usuario->type ==='facilitator'){
        return redirect('tablero-facilitador');
      }elseif($usuario->type ==='fellow'){
        return redirect('tablero');
      }else{
        abort(403, 'Unauthorized action.');
      }

  }
}
