<?php

namespace App\Http\Middleware;

use Auth;
use Closure;

class Student
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
        if (\Illuminate\Support\Facades\Auth::user()->user_type == 'teacher') {
            return redirect()->route('home');
        }
        if (Auth::user()->user_type == 'student') {
            return $next($request);
        }

    }
}
