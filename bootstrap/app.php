<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Auth\AuthenticationException;
use App\Http\Middleware\RedirectIfAuthenticated;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        $middleware->alias([
            'guest' => RedirectIfAuthenticated::class,
            'admin.guest' => RedirectIfAuthenticated::class,
            'admin.auth' => \App\Http\Middleware\AdminAuthenticate::class,
            'single.session' => \App\Http\Middleware\SingleSessionMiddleware::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
    
        $exceptions->render(function (AuthenticationException $e, Request $request) {
            if ($request->expectsJson()) {
                return response()->json(['message' => 'Unauthenticated.'], 401);
            }
 
            $guard = Arr::get($e->guards(), 0);

            switch (true) {
                case $request->is('admin') || $request->is('admin/*'):
                case $guard === 'admin':
                    $loginRoute = 'admin.login';
                    break;

                default:
                    $loginRoute = 'login';
                    break;
            }
            return redirect()->route($loginRoute);
        });    
    })->create();
