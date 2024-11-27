<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AuthMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if (!session()->has('user_id')) {
            return redirect()->route('login');
        }

        // Jika mencoba mengakses route admin tapi bukan admin
        if ($request->is('admin*') && !session('is_admin')) {
            return redirect()->route('home')->with('error', 'Unauthorized access');
        }

        return $next($request);
    }
} 