<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use App\Http\Middleware\AdminAuth;
use App\Http\Middleware\TrackPageViews;
use App\Http\Middleware\TrackAdminPageViews;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        // Register the AdminAuth middleware with an alias
        $middleware->alias([
            'admin.auth' => AdminAuth::class,
        ]);
    })
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->alias([
            'track.page.views' => TrackPageViews::class,
            'track.admin.page.views' => TrackAdminPageViews::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();