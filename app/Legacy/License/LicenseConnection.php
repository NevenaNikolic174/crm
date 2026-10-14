<?php

namespace App\Legacy\License;

use App\Legacy\Models\License;
use Illuminate\Database\ConnectionInterface;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;

final class LicenseConnection
{
    public static function name(): string
    {
        return (string) config('legacy.license_connection', 'license');
    }

    public static function db(): ConnectionInterface
    {
        return DB::connection(self::name());
    }

    /**
     * @return array{0: string, 1: int}
     */
    public static function resolveHost(?string $dbHost): array
    {
        $dbHost = (string) $dbHost;
        $servers = (array) config('legacy.db_servers', []);
        $srv = $servers[$dbHost] ?? null;

        if (is_string($srv) && is_array(config("database.connections.{$srv}"))) {
            return [
                (string) config("database.connections.{$srv}.host", $dbHost),
                (int) config("database.connections.{$srv}.port", 3306),
            ];
        }

        return [$dbHost, 3306];
    }

    public static function connect(object $license, ?int $licenseId = null, string $context = ''): void
    {
        [$host, $port] = self::resolveHost($license->DBHost ?? null);

        self::configure(
            $host,
            $port,
            (string) ($license->DataBaseName ?? ''),
            (string) ($license->DataBaseUser ?? ''),
            (string) ($license->DataBasePassword ?? ''),
        );

        if ($licenseId !== null && $licenseId > 0 && config('legacy.auto_create_db_account')) {
            app(EnsureDbAccount::class)->execute($licenseId, $context);
        }
    }

    public static function connectById(int $licenseId, string $context = ''): bool
    {
        $license = License::query()->find($licenseId);

        if ($license === null) {
            return false;
        }

        self::connect($license, $licenseId, $context);

        return true;
    }

    public static function storeInSession(object $license): void
    {
        [$host, $port] = self::resolveHost($license->DBHost ?? null);

        session([
            'dbhost' => $host,
            'dbport' => $port,
            'dbname' => $license->DataBaseName ?? null,
            'dbuser' => $license->DataBaseUser ?? null,
            'dbpass' => $license->DataBasePassword ?? null,
        ]);
    }

    public static function connectFromSession(): bool
    {
        $database = (string) session('dbname', '');

        if ($database === '') {
            return false;
        }

        self::configure(
            (string) session('dbhost', ''),
            (int) session('dbport', 3306),
            $database,
            (string) session('dbuser', ''),
            (string) session('dbpass', ''),
        );

        return true;
    }

    private static function configure(string $host, int $port, string $database, string $username, string $password): void
    {
        $name = self::name();

        Config::set("database.connections.{$name}", [
            'driver' => 'mysql',
            'host' => $host,
            'port' => $port,
            'database' => $database,
            'username' => $username,
            'password' => $password,
            'unix_socket' => '',
            'charset' => 'utf8mb4',
            'collation' => 'utf8mb4_unicode_ci',
            'prefix' => '',
            'prefix_indexes' => true,
            'strict' => false,
            'engine' => null,
        ]);

        DB::purge($name);
    }
}
