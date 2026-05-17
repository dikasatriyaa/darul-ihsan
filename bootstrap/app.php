<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

// 1. Biarkan Laravel mengonfigurasi dirinya sendiri terlebih dahulu
$app = Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        //
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();

// 2. AMAN: Set folder kompilasi view setelah objek $app berhasil di-create
if (env('APP_ENV') === 'production') {
    config(['view.compiled' => '/tmp/storage/framework/views']);
}

return $app;
