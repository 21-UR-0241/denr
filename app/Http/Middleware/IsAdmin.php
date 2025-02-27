<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;


class IsAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle($request, Closure $next)
    {
         // Check if the user is authenticated and their userType is 0
         if (Auth::check() && Auth::user()->role == "Admin") {
            return $next($request);
        }

        // If not, redirect to a different page (e.g., home or login)
        return redirect('/');
    }
    
}
