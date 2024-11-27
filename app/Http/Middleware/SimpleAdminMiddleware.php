<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class SimpleAdminMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if (!session('is_admin')) {
            return redirect('/')->with('error', 'Unauthorized access');
        }
        return $next($request);
    }
} 