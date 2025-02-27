<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function handle(Request $request, Closure $next)
    {
        // If the user is authenticated, redirect them to the dashboard or home page
        if (Auth::check()) {
            if ($request->is('login')) {
                // Redirect to the previous page they were trying to access
                return redirect()->intended('/'); // Default fallback route
            }
        }

        return $next($request);
    }
}
