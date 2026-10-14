<?php

namespace App\Legacy\License;

use Illuminate\Database\ConnectionInterface;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use RuntimeException;
use Throwable;

final class CreateDbUser
{
    /**
     * @return string IP aplikativnog servera za koji je nalog napravljen
     */
    public function execute(int $licenseID): string
    {
        $licence = DB::connection((string) config('legacy.office_master_connection', 'office_master'))
            ->table('office_license')
            ->where('ID', $licenseID)
            ->first();

        if ($licence === null || empty($licence->DataBaseName) || empty($licence->DataBaseUser)) {
            throw new RuntimeException("Licenca {$licenseID} nema podatke o bazi.");
        }

        if (! preg_match('/^[A-Za-z0-9_]+$/', (string) $licence->DataBaseUser)
            || ! preg_match('/^[A-Za-z0-9_]+$/', (string) $licence->DataBaseName)) {
            throw new RuntimeException("Licenca {$licenseID} ima nevalidno ime baze ili korisnika.");
        }

        $servers = (array) config('legacy.db_servers', []);
        $adminConnection = $servers[(string) $licence->DBHost] ?? null;

        if (! is_string($adminConnection)) {
            throw new RuntimeException("DBHost '{$licence->DBHost}' licence {$licenseID} nema admin konekciju (legacy.db_servers).");
        }

        $db = DB::connection($adminConnection);
        $applicationServer = $this->resolveApplicationServer($db);

        if (! in_array($applicationServer, (array) config('legacy.allowed_app_servers', []), true)) {
            throw new RuntimeException("Aplikativni server {$applicationServer} nije na listi dozvoljenih (legacy.allowed_app_servers).");
        }

        $userHost = "'{$licence->DataBaseUser}'@'{$applicationServer}'";
        $logContext = ['licenseID' => $licenseID, 'applicationServer' => $applicationServer, 'databaseServer' => $licence->DBHost];

        try {
            $db->statement(
                "CREATE USER IF NOT EXISTS {$userHost} IDENTIFIED BY "
                .$db->getPdo()->quote((string) $licence->DataBasePassword)
            );
        } catch (Throwable $e) {
            self::log('warning', 'CREATE USER failed: '.self::sanitizeMessage($e->getMessage(), $licence), $logContext);

            $alreadyExists = str_contains($e->getMessage(), 'exists')
                || ($e instanceof QueryException && (int) ($e->errorInfo[1] ?? 0) === 1396);

            if (! $alreadyExists) {
                throw $e;
            }
        }

        try {
            $db->statement("GRANT ALL PRIVILEGES ON `{$licence->DataBaseName}`.* TO {$userHost}");
        } catch (Throwable $e) {
            self::log('error', 'GRANT failed: '.self::sanitizeMessage($e->getMessage(), $licence), $logContext);

            throw $e;
        }

        try {
            $db->statement('FLUSH PRIVILEGES');
        } catch (Throwable) {
        }

        return $applicationServer;
    }

    private function resolveApplicationServer(ConnectionInterface $db): string
    {
        $row = $db->selectOne("SELECT SUBSTRING_INDEX(USER(), '@', -1) AS host");
        $seen = trim((string) ($row->host ?? ''));
        $host = $seen;

        if ($host !== '' && ! filter_var($host, FILTER_VALIDATE_IP)) {
            $resolved = gethostbyname($host);
            $host = $resolved !== $host ? $resolved : '';
        }

        if ($host === '' || ! filter_var($host, FILTER_VALIDATE_IP)) {
            throw new RuntimeException("DB server nije vratio IP aplikativnog servera (dobijeno: '{$seen}').");
        }

        return $host;
    }

    /**
     * @param  array<string, mixed>  $context
     */
    public static function log(string $level, string $message, array $context = []): void
    {
        try {
            Log::channel('create_mysql_account')->log($level, $message, $context);
        } catch (Throwable $e) {
            try {
                Log::log($level, '[create_mysql_account] '.$message, $context + ['logError' => $e->getMessage()]);
            } catch (Throwable) {
            }
        }
    }

    public static function sanitizeMessage(string $message, ?object $licence = null): string
    {
        $message = (string) preg_replace("/IDENTIFIED BY\s+'[^']*'/i", "IDENTIFIED BY '[REDACTED]'", $message);
        $message = (string) preg_replace('/IDENTIFIED BY\s+"[^"]*"/i', 'IDENTIFIED BY "[REDACTED]"', $message);
        $message = (string) preg_replace("/(?:CREATE USER(?: IF NOT EXISTS)?|TO)\s+'[^']+'@'[^']+'/i", '[REDACTED_USER_HOST]', $message);
        $message = (string) preg_replace('/`[^`]+`\.\*/', '`[REDACTED_DB]`.*', $message);

        if ($licence !== null) {
            $replacements = [
                'DataBasePassword' => '[REDACTED]',
                'DataBaseUser' => '[REDACTED_USER]',
                'DataBaseName' => '[REDACTED_DB]',
            ];

            foreach ($replacements as $field => $replacement) {
                $value = (string) ($licence->{$field} ?? '');

                if ($value !== '') {
                    $message = str_replace($value, $replacement, $message);
                }
            }
        }

        return $message;
    }
}
