<?php

namespace App\Legacy\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Symfony\Component\HttpFoundation\Response;

final class CheckUserRole
{
    /**
     * @param  Closure(Request): Response  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (in_array(session('userRole'), ['ADMIN', 'SADMIN'], true)) {
            if ($request->route()?->getName() === 'login') {
                return redirect($this->homeUrl());
            }

            return $next($request);
        }

        return redirect($this->homeUrl(['redirected' => true]));
    }

    /**
     * @param  array<string, mixed>  $params
     */
    private function homeUrl(array $params = []): string
    {
        return Route::has('home') ? route('home', $params) : url('/', $params);
    }
}
