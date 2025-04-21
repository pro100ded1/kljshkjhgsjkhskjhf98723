<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckMiniApp
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)
{
    $userAgent = $request->header('User-Agent');
    if (!str_contains($userAgent, 'TelegramMiniApp')) {
        abort(403, 'Доступ только через Telegram Mini App');
    }
    return $next($request);
}
}
