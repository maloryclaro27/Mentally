<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        $middleware->alias([
            'test.cooldown' => \App\Http\Middleware\EnsureTestCooldown::class,
            'is_especialista' => \App\Http\Middleware\IsEspecialista::class,
            'is_verificado' => \App\Http\Middleware\IsEspecialistaVerificado::class,
            'block_unverified_especialista' => \App\Http\Middleware\BlockUnverifiedEspecialista::class,
        ]);
        $middleware->encryptCookies(except: [
            'auth0_transient_0',
            'auth0_session_0',
            'auth0_session_1',
            'auth0__state',
            'auth0__nonce',
            'auth0__webauth_state',
        ]);
        //
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })->create();
