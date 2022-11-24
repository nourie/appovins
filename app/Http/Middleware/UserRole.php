<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class UserRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if (Auth::check()){
            if (auth()->user()->userrole==2)
            {
                return response()->view('welcome');
    
            }
            elseif(auth()->user()->userrole==1)
            {
                
                return $next($request);
    
            }
            else {
                return response('eeeee');
            }


        }
        
        else {
           return abort(403);
        }
       
    }
}
