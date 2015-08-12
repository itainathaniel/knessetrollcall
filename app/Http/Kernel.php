<?php

namespace KnessetRollCall\Http;

use Illuminate\Foundation\Http\Kernel as HttpKernel;

class Kernel extends HttpKernel
{
    /**
     * The application's global HTTP middleware stack.
     *
     * @var array
     */
    protected $middleware = [
        \Illuminate\Foundation\Http\Middleware\CheckForMaintenanceMode::class,
        \KnessetRollCall\Http\Middleware\EncryptCookies::class,
        \Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse::class,
        \Illuminate\Session\Middleware\StartSession::class,
        \Illuminate\View\Middleware\ShareErrorsFromSession::class,
        \KnessetRollCall\Http\Middleware\VerifyCsrfToken::class,
        \KnessetRollCall\Http\Middleware\UserisAdmin::class,
    ];

    /**
     * The application's route middleware.
     *
     * @var array
     */
    protected $routeMiddleware = [
        'auth' => \KnessetRollCall\Http\Middleware\Authenticate::class,
        'auth.basic' => \Illuminate\Auth\Middleware\AuthenticateWithBasicAuth::class,
        'guest' => \KnessetRollCall\Http\Middleware\RedirectIfAuthenticated::class,
        'admin' => \KnessetRollCall\Http\Middleware\UserisAdmin::class,
    ];
}
