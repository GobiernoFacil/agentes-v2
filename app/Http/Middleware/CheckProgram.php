<?php

namespace App\Http\Middleware;

use Closure;
use App\User;
use Auth;
use App\Models\Program;
class CheckProgram
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
      //verifica que el usuario pertenezca al programa
      $program = Program::where('public',1)->where('slug',$request->program_slug)->first();
      $user    = Auth::user();
      if($program){
        if($request->user()->actual_program()->id === $program->id){
          if(isset($request->activity_slug)){
            if($user->check_progress($request->activity_slug,2)){
              return $next($request);
            }else{
              return back()->with(['error'=>"Aún no puedes accesar a esa actividad, visualiza tu progreso en <a href='".url("tablero/$program->slug/progreso")."'>Ir a progreso</a>"]);
            }

          }elseif(isset($request->session_slug)){
            if($user->check_progress($request->session_slug,1)){
              return $next($request);
            }else{
              return redirect("tablero")->with(['error'=>"Aún no puedes accesar a esa sesión, visualiza tu progreso en <a href='".url("tablero/$program->slug/progreso")."'>Ir a progreso</a>"]);
            }
          }elseif(isset($request->module_slug)){
            if($request->url()=== url("tablero/$program->slug/progreso/$request->module_slug")){
                return $next($request);
            }
            if($user->check_progress($request->module_slug,0)){
              return $next($request);
            }else{
              return redirect("tablero")->with(['error'=>"Aún no puedes accesar a ese módulo, visualiza tu progreso en <a href='".url("tablero/$program->slug/progreso")."'>Ir a progreso</a>"]);
            }
          }else{
            return $next($request);
          }


        }else{
             return redirect("tablero");
        }


      }else{
        return redirect("tablero")->with(['error'=>'No te encuentras inscrito al programa, por favor contacta a soporte técnico.']);
      }
    }
}
