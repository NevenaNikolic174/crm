<?php

namespace App\Legacy\License;

use Illuminate\Support\Facades\DB;
use stdClass;
use Throwable;

final class EnsureDbAccount
{
    public function __construct(
        private readonly CreateDbUser $createDbUser,
    ) {}

    public function execute(int $licenseID, string $context = '', ?string $connection = null): bool
    {
        $connection ??= LicenseConnection::name();
        $credentials = $this->connectionCredentials($connection);

        $logContext = [
            'context' => $context,
            'licenseID' => $licenseID,
            'connection' => $connection,
            'database' => $credentials->DataBaseName,
            'databaseHost' => $credentials->DBHost,
        ];

        $error = $this->tryConnect($connection);

        if ($error === null) {
            return true;
        }

        if ($licenseID === 0 || ! $this->isAccessDenied($error)) {
            CreateDbUser::log(
                'warning',
                'Konekcija na licencu nije uspela, nalog se ne kreira: '.CreateDbUser::sanitizeMessage($error->getMessage(), $credentials),
                $logContext
            );

            return false;
        }

        try {
            $logContext['applicationServer'] = $this->createDbUser->execute($licenseID);
        } catch (Throwable $e) {
            CreateDbUser::log(
                'error',
                'Kreiranje MySQL naloga nije uspelo: '.CreateDbUser::sanitizeMessage($e->getMessage(), $credentials),
                $logContext
            );

            return false;
        }

        DB::purge($connection);

        $error = $this->tryConnect($connection);

        if ($error === null) {
            CreateDbUser::log('info', 'SUCCESS | MySQL nalog napravljen i konekcija radi', $logContext);

            return true;
        }

        CreateDbUser::log(
            'error',
            'Nalog napravljen, ali konekcija i dalje ne radi: '.CreateDbUser::sanitizeMessage($error->getMessage(), $credentials),
            $logContext
        );

        return false;
    }

    private function connectionCredentials(string $connection): stdClass
    {
        $config = (array) config("database.connections.{$connection}", []);

        return (object) [
            'DBHost' => $config['host'] ?? null,
            'DataBaseName' => $config['database'] ?? null,
            'DataBaseUser' => $config['username'] ?? null,
            'DataBasePassword' => $config['password'] ?? null,
        ];
    }

    private function tryConnect(string $connection): ?Throwable
    {
        try {
            DB::connection($connection)->getPdo();

            return null;
        } catch (Throwable $e) {
            return $e;
        }
    }

    private function isAccessDenied(Throwable $e): bool
    {
        return (int) $e->getCode() === 1045
            || str_contains($e->getMessage(), '[1045]')
            || str_contains($e->getMessage(), 'Access denied');
    }
}
