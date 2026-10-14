<?php

namespace App\Legacy\Services;

use App\Legacy\Auth\LegacyAuth;
use App\Legacy\Exceptions\LoginException;
use App\Legacy\License\LicenseConnection;
use App\Legacy\License\LicensePackages;
use App\Legacy\License\OfficeMasterRepository;
use App\Legacy\License\TimeAvailability;
use App\Legacy\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Throwable;

class LoginService
{
    public const VIA_KANCELARKO = 'kancelarko';

    public const VIA_FORM = 'form';

    public function __construct(
        private readonly OfficeMasterRepository $officeMaster,
        private readonly LicensePackages $packages,
        private readonly LoginSessionService $loginSession,
    ) {}

    /**
     * @return array<int, object>
     */
    public function matchingLicenses(string $username, string $password, ?int $licenseId = null): array
    {
        $matches = [];

        foreach ($this->officeMaster->getUserLicenses($username, $licenseId) as $license) {
            $id = (int) ($license->licenseID ?? 0);

            try {
                LicenseConnection::connect($license, $id, 'LoginService.matchingLicenses');

                $user = LicenseConnection::db()->table('users')
                    ->where('username', $username)
                    ->where('enable', 1)
                    ->where('archived', 0)
                    ->first();
            } catch (Throwable $e) {
                Log::channel('errorLogin')->warning("Licenca {$id}: konekcija na bazu nije uspela: ".$e->getMessage());

                continue;
            }

            if ($user === null || ! $this->passwordMatches($password, $user->password ?? null)) {
                continue;
            }

            $license->companyNames = $this->companyNames($id);
            $matches[] = $license;
        }

        return $matches;
    }

    public function licenseForUser(string $username, int $licenseId): ?object
    {
        return $this->officeMaster->getUserLicenses($username, $licenseId)[0] ?? null;
    }

    public function sqlAccountExists(object $license, int $licenseId, string $username): bool
    {
        LicenseConnection::connect($license, $licenseId, 'LoginService.sqlAccountExists');

        try {
            LicenseConnection::db()->table('users')->where('username', $username)->first();
        } catch (Throwable $e) {
            Log::channel('errorLogin')->warning('Konekcija na bazu licence '.$licenseId.' nije uspela: '.$e->getMessage());

            return false;
        }

        return true;
    }

    /**
     * @param  string  $via  self::VIA_KANCELARKO | self::VIA_FORM (pamti se u sesiji, logout zavisi od toga)
     *
     * @throws LoginException poruka za korisnika
     */
    public function complete(object $license, string $username, Request $request, string $via): User
    {
        $licenseId = (int) ($license->licenseID ?? 0);
        $appCode = (string) ($license->appCode ?? '');
        $timeGroup = $license->TimeAvailabilityGroup ?? null;

        $orgResponse = $this->packages->fetchFromOrg($appCode);

        if ((int) ($orgResponse->code ?? 0) === 200) {
            $orgPackages = is_array($orgResponse->data ?? null) ? array_values($orgResponse->data) : [];

            if ($orgPackages === []) {
                Log::channel('errorLogin')->info('Failed app: '.$appCode);

                throw new LoginException(
                    'Nije uspelo prijavljivanje, molimo Vas kontaktirajte tehničku podršku na telefon '
                    .config('legacy.support_phones').' i pročitajte im sledeći kod: '.$appCode
                );
            }

            $this->packages->storeInSession($orgPackages);
        } else {
            $this->packages->storeInSession($this->officeMaster->backupPackageData($appCode));
        }

        if (! $this->packages->hasAnyLoginModule()) {
            throw new LoginException(
                'Period trajanja svih paketa licence '.$appCode.' je istekao. Ukoliko želite da obnovite pretplatu, '
                .'pozovite službu stručne promocije i komercijale. Ukoliko smatrate da ste ovu poruku dobili greškom, '
                .'pozovite službu tehničke podrške: '.config('legacy.support_phones')
            );
        }

        if (TimeAvailability::notIn($timeGroup)) {
            throw new LoginException(
                'Pristup aplikaciji je dozvoljen samo '.TimeAvailability::getTimes($timeGroup).'.'
            );
        }

        $user = User::query()->where('username', $username)->first();

        if ($user === null) {
            Log::channel('errorLogin')->info("Korisnik {$username} ne postoji u bazi licence {$licenseId}");

            throw new LoginException('Korisnik ne postoji u bazi licence.');
        }

        Session::put('licenseid', $licenseId);
        Session::put('licenseapp', $appCode);
        Session::put('timeGroup', $timeGroup);
        Session::put('storageSize', $this->readStorageSize($licenseId));
        LicenseConnection::storeInSession($license);

        LegacyAuth::guard()->login($user);
        $request->session()->regenerate();

        $this->loginSession->store($user);
        Session::put('legacyLoginVia', $via);

        try {
            LicenseConnection::db()->table('users')->where('id', $user->id)->update(['userLoggedIn' => 1]);
        } catch (Throwable $e) {
            Log::channel('errorLogin')->warning('userLoggedIn=1 nije upisan: '.$e->getMessage());
        }

        return $user;
    }

    private function passwordMatches(string $password, mixed $hash): bool
    {
        if (! is_string($hash) || $hash === '') {
            return false;
        }

        try {
            return Hash::check($password, $hash);
        } catch (Throwable) {
            return false;
        }
    }

    private function companyNames(int $licenseId): string
    {
        try {
            $names = LicenseConnection::db()->table('company')
                ->where('localCompany', 1)
                ->where('companyName', '<>', 'Eksterni korisnici')
                ->pluck('companyName')
                ->all();
        } catch (Throwable) {
            $names = [];
        }

        return $names === [] ? 'Licenca '.$licenseId : implode(', ', $names);
    }

    private function readStorageSize(int $licenseId): string
    {
        try {
            $file = 'Folder_'.$licenseId.'_size.txt';
            $contents = Storage::exists($file) ? trim((string) Storage::get($file)) : '';

            return $contents === '' ? '0' : $contents;
        } catch (Throwable) {
            return '0';
        }
    }
}
