<?php

use App\Legacy\License\LicenseConnection;
use App\Legacy\Models\License;
use Illuminate\Database\ConnectionInterface;

if (! function_exists('checkmodule')) {
    /**
     * @param  string|list<string>  $modules
     */
    function checkmodule(string|array $modules): bool
    {
        $authmodules = session('licenseModule');

        if (! is_array($authmodules)) {
            return false;
        }

        $modules = (array) $modules;

        foreach ($modules as $module) {
            if ((int) ($authmodules[$module] ?? 0) !== 1) {
                return false;
            }
        }

        return $modules !== [];
    }
}

if (! function_exists('isLight')) {
    function isLight(): bool
    {
        return (int) session('lightPrincipal', 0) === 1;
    }
}

if (! function_exists('isSupervisor')) {
    function isSupervisor(): bool
    {
        $supervisors = json_decode((string) session('supervisorArr', '[]'), true);

        if (! is_array($supervisors)) {
            return false;
        }

        return in_array((int) session('employeeID'), array_map('intval', $supervisors), true);
    }
}

if (! function_exists('get_visitor_IP')) {
    function get_visitor_IP(): string
    {
        $cloudflare = $_SERVER['HTTP_CF_CONNECTING_IP'] ?? null;

        if (is_string($cloudflare) && filter_var($cloudflare, FILTER_VALIDATE_IP)) {
            return $cloudflare;
        }

        $clientIp = $_SERVER['HTTP_CLIENT_IP'] ?? null;

        if (is_string($clientIp) && filter_var($clientIp, FILTER_VALIDATE_IP)) {
            return $clientIp;
        }

        $forwarded = $_SERVER['HTTP_X_FORWARDED_FOR'] ?? null;

        if (is_string($forwarded) && $forwarded !== '') {
            foreach (explode(',', $forwarded) as $ip) {
                $ip = trim($ip);

                if (filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_NO_PRIV_RANGE | FILTER_FLAG_NO_RES_RANGE)) {
                    return $ip;
                }
            }
        }

        return (string) ($_SERVER['REMOTE_ADDR'] ?? '');
    }
}

if (! function_exists('validateLicense')) {
    function validateLicense(int $licenseId): bool
    {
        try {
            return License::query()->whereKey($licenseId)->exists();
        } catch (Throwable) {
            return false;
        }
    }
}

if (! function_exists('setDatabaseConnection')) {
    function setDatabaseConnection(int $license_id): bool
    {
        try {
            return LicenseConnection::connectById($license_id, 'helpers.setDatabaseConnection');
        } catch (Throwable) {
            return false;
        }
    }
}

if (! function_exists('legacy_db')) {
    function legacy_db(): ConnectionInterface
    {
        return LicenseConnection::db();
    }
}
