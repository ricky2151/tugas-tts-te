<?php

namespace App\Http\Middleware;

use Closure;

if(!isset($_SESSION)) 
{ 
    session_start(); 
} 

class CheckRoleStatus
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
        if(isset($_SESSION['role']) && $_SESSION['role'] == 'admin'){
            return $next($request);
        }
        else return redirect('/')->with('alert-failed','Ilegal Operation');;
    }
}
