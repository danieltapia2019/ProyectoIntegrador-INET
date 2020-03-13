<?php

namespace App\Http\Middleware;

use Closure;

class Roles
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next,$user)
    {
        if($request->user()->acceso != 0){
          abort(403,'No tienes el acceso suficiente para estar en la pagina');
        }
        return $next($request);
    }
}
