<?php

namespace App\Http;

use Illuminate\Foundation\Http\Kernel as HttpKernel;

class Kernel extends HttpKernel
{
    /**
     * The application's route middleware.
     *
     * These middleware may be assigned to groups or used individually.
     *
     * @var array
     */
    protected $routeMiddleware = [
        // ... existing middlewares ...
        'auth.simple' => \App\Http\Middleware\SimpleAuthMiddleware::class,
        'admin.simple' => \App\Http\Middleware\AdminAuth::class,
    ];
} 