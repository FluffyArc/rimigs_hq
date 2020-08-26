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

        if (!Auth::check()) {
            return redirect()->route('clientLogin');
        }

        if (Auth::user()->user_type == 'teacher') {
            return $next($request);
        }
        if (Auth::user()->user_type == 'student') {
            return redirect()->route('clientHome');
        }
    }
}
