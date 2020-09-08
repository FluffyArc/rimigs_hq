<?php

namespace App\Http\Middleware;

use Illuminate\Support\Facades\Auth;
use Closure;

class Admin
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

        if (Auth::user()->user_type == 'teacher' || Auth::user()->user_type == 'assistant') {
            return $next($request);
        }
        /*if (Auth::user()->user_type == 'assistant') {
            return redirect()->route('posts');
        }*/
        if (Auth::user()->user_type == 'student') {
            return redirect()->route('subjects');
        }
    }
}
