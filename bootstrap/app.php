<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use App\Http\Middleware\CheckNurseType;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        //register checkUserType middleware

        // $middleware->append(CheckNurseType::class);

        $middleware->alias([
            'nurse.type' => CheckNurseType::class
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
