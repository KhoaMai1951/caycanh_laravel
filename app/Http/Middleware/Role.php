<?php

namespace App\Http\Middleware;

use Closure;

class Role
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
//        if(auth()->user()->role_id == 3){
//            return $next($request);
//        }
//        abort(403);

        if(auth()->user()->role_id == 3){
            #
        }else{
            return redirect('login');
        }
        return $next($request);
    }
}
