<?php

namespace App\Legacy\Http\Middleware;

use App\Legacy\Http\Concerns\LegacyResponses;
use App\Legacy\Module\AppModule;
use App\Legacy\Module\AppModuleChecker;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

final class CheckModule
{
    use LegacyResponses;

    public function __construct(
        private readonly AppModuleChecker $checker,
    ) {}

    /**
     * @param  Closure(Request): Response  $next
     */
    public function handle(Request $request, Closure $next, string $module): Response
    {
        if ($this->checker->check($module) || ! empty(session('gost'))) {
            return $next($request);
        }

        $names = array_map(static fn (string $m): string => AppModule::getModuleName($m), explode('#', $module));

        $message = 'Poštovani, nemate pravo pristupa modulu '.implode(' / ', $names).'. '
            .'Ukoliko smatrate da ste ovu poruku dobili greškom pozovite službu tehničke podrške '
            .config('legacy.support_phones').' i saopštite im ovaj kod: '.session('licenseapp');

        return $this->errorView($message, 403);
    }
}
