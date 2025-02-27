<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckSuperadmin
{
    public function handle(Request $request, Closure $next)
    {
        // Check if the logged-in user is a Superadmin
        if (Auth::check() && Auth::user()->role === 'Superadmin') {
            return $next($request);  // Allow the request to proceed
        }

        // If not a Superadmin, redirect with an error message
        return redirect('/home')->with('message', 'You do not have permission to access this page.');
    }
}
