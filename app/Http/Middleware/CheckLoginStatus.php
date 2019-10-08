<?php

namespace App\Http\Middleware;

use Closure;

if(!isset($_SESSION)) 
{ 
    session_start(); 
} 

class CheckLoginStatus
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
        if(isset($_SESSION['is_login']) && $_SESSION['is_login'] == 'TRUE'){
            return $next($request);
        }
        else return redirect('/login');
        
    }
}
