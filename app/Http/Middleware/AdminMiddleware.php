<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
       if(auth()->user()->group!=2){
        return response()->json(['message' => 'У вас нет доступа к панели управления']);
        //return abort(403);
       }

        return $next($request);
    }
}
