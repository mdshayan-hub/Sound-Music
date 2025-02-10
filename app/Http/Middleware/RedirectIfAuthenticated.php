<?php

// app/Http/Middleware/RedirectIfAuthenticated.php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    public function handle(Request $request, Closure $next)
    {
        if (Auth::check()) {
            // Agar user logged in hai, to login aur register page par redirect karo
            return redirect('/user/home');
        }

        return $next($request);
    }
}

