<?php

namespace App\Http\Controllers;
use Auth;
use App\Models\Log;
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
        $program = $usuario->actual_program();
        if($program){
          if(Log::where('user_id',$usuario->id)->where('type','first')->where('program_id',$program->id)->first()){
            return redirect('tablero');
          }else{
            return redirect('tablero/informacion');
          }
        }else{
          return redirect('tablero');
        }

      }elseif($usuario->type ==='aspirant'){
        return redirect('tablero-aspirante');
      }else{
        abort(403, 'Unauthorized action.');
      }

  }
}
