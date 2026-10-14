<?php

namespace App\Legacy\Http\Middleware;

use App\Legacy\Auth\LegacyAuth;
use App\Legacy\Http\Concerns\LegacyResponses;
use App\Legacy\License\LicenseConnection;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Throwable;

final class CheckUserLoggedIn
{
    use LegacyResponses;

    /**
     * @param  Closure(Request): Response  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (LegacyAuth::check() && $this->userLoggedInOnKancelarko()) {
            return $next($request);
        }

        $url = rtrim((string) config('legacy.kancelarko_url'), '/').'/redirectModuleLogin?'.http_build_query([
            'src' => config('legacy.module_url'),
            'route' => $request->path(),
        ]);

        return $this->externalRedirect($url);
    }

    private function userLoggedInOnKancelarko(): bool
    {
        try {
            $flag = LicenseConnection::db()->table('users')->where('id', LegacyAuth::id())->value('userLoggedIn');
        } catch (Throwable) {
            return false;
        }

        return (int) $flag === 1;
    }
}
