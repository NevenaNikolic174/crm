<?php

namespace App\Legacy\Http\Middleware;

use App\Legacy\Auth\LegacyAuth;
use App\Legacy\License\LicenseConnection;
use App\Legacy\License\OfficeMasterRepository;
use App\Legacy\License\TimeAvailability;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Symfony\Component\HttpFoundation\Response;

final class CheckDataSession
{
    public function __construct(
        private readonly OfficeMasterRepository $officeMaster,
    ) {}

    /**
     * @param  Closure(Request): Response  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if ($request->hasSession() && $request->session()->has('localeLang')) {
            App::setLocale((string) $request->session()->get('localeLang'));
        }

        LicenseConnection::connectFromSession();

        $user = LegacyAuth::user();

        if ($user === null) {
            return $next($request);
        }

        if ((int) ($user->userLoggedIn ?? 1) === 0) {
            LegacyAuth::guard()->logout();

            return $next($request);
        }

        $session = $request->session();

        if (! $session->has('firstname') || ! $session->has('lastname') || ! $session->has('employeeID')
            || TimeAvailability::notIn($session->get('timeGroup'))) {
            LegacyAuth::guard()->logout();

            return $next($request);
        }

        $officeUser = $this->officeMaster->findOfficeUser((string) $user->username);

        if ($officeUser === null || (int) ($officeUser->userAcitve ?? 0) !== 1) {
            LegacyAuth::guard()->logout();

            return $next($request);
        }

        if (! empty($officeUser->emailVerificationCode) && ! $request->is('logout')) {
            return redirect(rtrim((string) config('legacy.kancelarko_url'), '/').'/checkemail');
        }

        return $next($request);
    }
}
