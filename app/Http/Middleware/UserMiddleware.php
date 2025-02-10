<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class UserMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        // Check if the user is authenticated and is not an admin
        if (auth()->check() && auth()->user()->role !== 'admin') {
            return $next($request);
        }
    
        // Redirect admin users to the admin dashboard
        return redirect('/admin/dashboard')->with('error', 'You do not have access to user-side routes.');


        if (Auth::check() && Auth::user()->role == 'User') {
            return $next($request); // Allow access to the next request
        }

        return redirect()->route('login'); // Redirect to login if user is not authenticated
    }

    
}

