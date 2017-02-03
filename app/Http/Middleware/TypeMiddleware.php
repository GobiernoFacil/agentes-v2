<?php

namespace App\Http\Middleware;

use Closure;

class TypeMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
     public function handle($request, Closure $next, $type,$orType= NULL)
     {
       if($request->user()->type == $type){
         return $next($request);
       }else{
            return redirect("guide-me");
       }

     }
}
