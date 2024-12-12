<?php

use App\Http\Middleware\StaffMiddleware;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\MiddlewarePriority;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function ($middleware) {
        // Menambahkan StaffMiddleware ke grup 'web'
        $middleware->middlewareGroups['web'][] = StaffMiddleware::class;
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
