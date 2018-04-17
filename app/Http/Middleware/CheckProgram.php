<?php

namespace App\Http\Middleware;

use Closure;
use App\User;
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

      $program = Program::where('public',1)->where('slug',$request->program_slug)->first();
      if($program){
        if($request->user()->actual_program()->id === $program->id){
          return $next($request);
        }else{
             return redirect("tablero");
        }


      }else{
        return redirect("tablero");
      }
    }
}
