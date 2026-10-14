<?php

namespace App\Legacy\Http\Middleware;

use App\Legacy\Auth\LegacyAuth;
use App\Legacy\Encrypt\ModuleEncrypter;
use App\Legacy\Http\Controllers\LoginController;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

final class RedirectIfAuthenticated
{
    public function __construct(
        private readonly ModuleEncrypter $encrypter,
    ) {}

    /**
     * @param  Closure(Request): Response  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (! LegacyAuth::check()) {
            return $next($request);
        }

        $data = $this->encrypter->getData((string) $request->route('hash'));

        if ($data === false) {
            return redirect('/');
        }

        $sameUser = ($data['username'] ?? null) === session('username')
            && (int) ($data['licenseID'] ?? 0) === (int) session('licenseid');

        if (! $sameUser) {
            LegacyAuth::guard()->logout();

            return $next($request);
        }

        return redirect(LoginController::safeRoute($data['route'] ?? null));
    }
}
