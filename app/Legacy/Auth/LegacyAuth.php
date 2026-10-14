<?php

namespace App\Legacy\Auth;

use App\Legacy\Models\User;
use Illuminate\Contracts\Auth\StatefulGuard;
use Illuminate\Support\Facades\Auth;

final class LegacyAuth
{
    public static function guardName(): string
    {
        return (string) config('legacy.guard', 'legacy');
    }

    public static function guard(): StatefulGuard
    {
        return Auth::guard(self::guardName());
    }

    public static function check(): bool
    {
        return self::guard()->check();
    }

    public static function user(): ?User
    {
        $user = self::guard()->user();

        return $user instanceof User ? $user : null;
    }

    public static function id(): ?int
    {
        $id = self::guard()->id();

        return $id === null ? null : (int) $id;
    }

    /**
     * @return array<string, mixed>
     */
    public static function sharedData(): array
    {
        $loggedIn = self::check();

        return [
            'loggedIn' => $loggedIn,
            'user' => $loggedIn ? [
                'id' => self::id(),
                'username' => session('username'),
                'firstname' => session('firstname'),
                'lastname' => session('lastname'),
                'employeeId' => session('employeeID'),
                'role' => session('userRole'),
                'realRole' => session('realRole'),
            ] : null,
            'license' => $loggedIn ? [
                'id' => session('licenseid'),
                'appCode' => session('licenseapp'),
                'subscriber' => session('subscriberData'),
                'modules' => session('licenseModule', []),
                'freePackage' => (bool) session('freePackage', false),
            ] : null,
            'module' => session('module'),
            'kancelarkoUrl' => config('legacy.kancelarko_url'),
        ];
    }
}
