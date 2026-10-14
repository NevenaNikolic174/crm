<?php

namespace App\Legacy\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

final class AuthMiddleware
{
    /**
     * @param  Closure(Request): Response  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (session('userRole')) {
            return $next($request);
        }

        return redirect()->route('login');
    }
}
