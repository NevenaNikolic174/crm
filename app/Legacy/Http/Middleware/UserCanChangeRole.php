<?php

namespace App\Legacy\Http\Middleware;

use App\Legacy\Encrypt\ModuleEncrypter;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Throwable;

final class UserCanChangeRole
{
    private const CHANGE_ROLE = 'CHANGE_ROLE';

    public function __construct(
        private readonly ModuleEncrypter $hasher,
    ) {}

    /**
     * @param  Closure(Request): Response  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        try {
            $action = $this->hasher->decrypt((string) $request->input('action'));
        } catch (Throwable) {
            return response()->json(['error' => 'Invalid action token'], 400);
        }

        if ($action !== self::CHANGE_ROLE) {
            return response()->json(['error' => 'Unauthorized action'], 403);
        }

        return $next($request);
    }
}
