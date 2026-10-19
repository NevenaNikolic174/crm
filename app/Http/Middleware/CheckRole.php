<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

final class CheckRole
{
    private const MODE_ANY = 'any';

    private const MODE_ALL = 'all';

    private const ACCESS_CRM_MANAGER = 'crm-manager';

    public function handle(Request $request, Closure $next, string ...$parameters): Response
    {
        if ($this->isAllowed($parameters)) {
            return $next($request);
        }

        abort(Response::HTTP_FORBIDDEN, 'Nemate pravo pristupa ovoj stranici.');
    }

    /**
     * @param  string[]  $parameters
     */
    private function isAllowed(array $parameters): bool
    {
        [$mode, $accessTypes] = $this->parseParameters($parameters);

        if ($accessTypes === []) {
            return false;
        }

        if (session('userRole') === 'SADMIN') {
            return true;
        }

        $results = array_map(fn (string $access): bool => $this->hasAccess($access), $accessTypes);

        return $mode === self::MODE_ALL
            ? ! in_array(false, $results, true)
            : in_array(true, $results, true);
    }

    /**
     * @param  string[]  $parameters
     * @return array{0: string, 1: string[]}
     */
    private function parseParameters(array $parameters): array
    {
        $parameters = array_values(array_filter(
            array_map(static fn (string $parameter): string => strtolower(trim($parameter)), $parameters),
            static fn (string $parameter): bool => $parameter !== '',
        ));

        $mode = self::MODE_ANY;

        if (isset($parameters[0]) && in_array($parameters[0], [self::MODE_ANY, self::MODE_ALL], true)) {
            $mode = array_shift($parameters);
        }

        return [$mode, array_values(array_unique($parameters))];
    }

    private function hasAccess(string $access): bool
    {
        return match ($access) {
            self::ACCESS_CRM_MANAGER => (int) session('crmManager', 0) === 1,
            default => false,
        };
    }
}
