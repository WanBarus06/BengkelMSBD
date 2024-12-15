<?php

use App\Http\Middleware\StaffMiddleware;
use App\Http\Middleware\OwnerMiddleware;
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
        // Menambahkan StaffMiddleware dan OwnerMiddleware ke grup 'web'
        $middleware->middlewareGroups['web'][] = StaffMiddleware::class;
        $middleware->middlewareGroups['web'][] = OwnerMiddleware::class; // Menambahkan OwnerMiddleware
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
