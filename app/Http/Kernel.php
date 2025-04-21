<?php

namespace App\Http;

use Illuminate\Foundation\Http\Kernel as HttpKernel;

class Kernel extends HttpKernel
{
    protected $middleware = [
        // ...
    ];

    protected $middlewareGroups = [
        'web' => [
            // ...
        ],
        'api' => [
            // ...
        ],
    ];

    // Добавьте здесь ваши middleware
    protected $routeMiddleware = [
        'auth' => \App\Http\Middleware\Authenticate::class,
        //'miniapp' => \App\Http\Middleware\CheckMiniApp::class,
        //'admin' => \App\Http\Middleware\CheckAdminRole::class,
    ];
}