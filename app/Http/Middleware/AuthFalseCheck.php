<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class AuthFalseCheck
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
        //dd($request);
        //return Redirect::back()->with('message','Operation Successful !');
        if (Session::has('loginid')) {
           // return redirect('login')->with('fail', 'You have to login first{False}');
            return redirect('/dashboard')->with('fail', 'You have to login first{False}');
            //return $next($request);
             // 
        }
       // return redirect('login')->with('fail', 'You have to login first{False}');
        // 
      // return Redirect::back()->with('message','Operation Successful{False} !');
      return $next($request);
    
    }
}
