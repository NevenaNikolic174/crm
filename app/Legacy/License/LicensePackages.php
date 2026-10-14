<?php

namespace App\Legacy\License;

use Carbon\CarbonImmutable;
use Illuminate\Http\Client\ConnectionException;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;

final class LicensePackages
{
    /**
     * @var array<string, string>
     */
    private const MODULES = [
        'MODULE_PRINCIPAL' => 'P_DATES',
        'MODULE_DELOVODNIK' => 'D_DATES',
        'MODULE_DELOVODNIK_ARHIVIRANJE' => 'D_ARCHIVING_DATES',
        'MODULE_SELFADMIN' => 'S_DATES',
        'MODULE_SELFADMIN_LITE' => 'SL_DATES',
        'MODULE_OBRADA_IZVODA' => 'OI_DATES',
        'MODULE_POSTMAN' => 'POSTMAN_DATES',
        'MODULE_KADROVIK' => 'KADROVIK_DATES',
        'MODULE_KADROVIK_LITE' => 'KADROVIK_LITE_DATES',
        'MODULE_RP' => 'RP_DATES',
        'MODULE_RESORSI' => 'RESORSI_DATES',
        'MODULE_PROCEDURE' => 'PROCEDURE_DATES',
        'MODULE_PREUZIMANJE_PODATAKA' => 'PREUZIMANJE_PODATAKA_DATES',
        'MODULE_TEXTS' => 'TEXTS_DATES',
        'MODULE_OCR' => 'OCR_DATES',
        'MODULE_BROWSER_EXTENSION' => 'BROWSER_EXTENSION_DATES',
        'MODULE_DOGADJAJI' => 'DOGADJAJI_DATES',
        'MODULE_ELMS' => 'ELMS_DATES',
        'MODULE_CRM' => 'CRM_DATES',
        'MODULE_FISKALNI' => 'FISKALNI_DATES',
        'MODULE_TROSKOVNIK' => 'TROSKOVNIK_DATES',
        'MODULE_TICKETING' => 'TICKETING_DATES',
        'MODULE_OBRASCI' => 'OBRASCI_DATES',
        'MODULE_OTPREMNICE' => 'OTPREMNICE_DATES',
        'MODULE_EMAIL_ZAVODJENJE' => 'EMAIL_ZAVODJENJE_DATES',
        'MODULE_POVEZIVANJE_PROPISA_PRAVNA_BAZA' => 'POVEZIVANJE_PROPISA_PRAVNA_BAZA_DATES',
        'MODULE_PARAGRAF_AI' => 'PARAGRAF_AI_DATES',
    ];

    /**
     * @var array<string, array{0: string, 1: bool, 2: list<string>}>
     */
    private const PACKAGES = [
        'Principal' => ['MODULE_PRINCIPAL', true, []],
        'e-Delovodnik' => ['MODULE_DELOVODNIK', true, []],
        'e-Arhiviranje' => ['MODULE_DELOVODNIK_ARHIVIRANJE', true, []],
        'e-Fakture' => ['MODULE_SELFADMIN', true, ['MODULE_POSTMAN']],
        'e-Fakture-free' => ['MODULE_SELFADMIN', false, ['MODULE_POSTMAN']],
        'e-Fakture-lite' => ['MODULE_SELFADMIN_LITE', true, []],
        'e-ObradaIzvoda' => ['MODULE_OBRADA_IZVODA', true, []],
        'e-Poštar' => ['MODULE_POSTMAN', true, []],
        'Kadrovik' => ['MODULE_KADROVIK', true, []],
        'Fiskalni' => ['MODULE_FISKALNI', true, []],
        'e-Magicin' => ['MODULE_RP', true, []],
        'Resursi' => ['MODULE_RESORSI', true, []],
        'e-Procedure' => ['MODULE_PROCEDURE', true, []],
        'preuzimanjePodataka' => ['MODULE_PREUZIMANJE_PODATAKA', true, []],
        'Ocr' => ['MODULE_OCR', true, []],
        'browserExtension' => ['MODULE_BROWSER_EXTENSION', true, []],
        'troskovnik' => ['MODULE_TROSKOVNIK', true, []],
        'tekstovi' => ['MODULE_TEXTS', true, []],
        'Dogadjaji' => ['MODULE_DOGADJAJI', true, []],
        'ELMS' => ['MODULE_ELMS', true, []],
        'e-Tiketi' => ['MODULE_TICKETING', true, []],
        'Obrasci' => ['MODULE_OBRASCI', true, []],
        'Otpremnice' => ['MODULE_OTPREMNICE', true, []],
        'emailZavodjenje' => ['MODULE_EMAIL_ZAVODJENJE', true, []],
        'povezivanjePravnaBaza' => ['MODULE_POVEZIVANJE_PROPISA_PRAVNA_BAZA', true, []],
        'PARAGRAF AI' => ['MODULE_PARAGRAF_AI', true, []],
    ];

    /**
     * @var list<string>
     */
    private const LOGIN_REQUIRES_ANY = [
        'MODULE_PRINCIPAL',
        'MODULE_DELOVODNIK',
        'MODULE_DELOVODNIK_ARHIVIRANJE',
        'MODULE_SELFADMIN',
        'MODULE_SELFADMIN_LITE',
        'MODULE_OBRADA_IZVODA',
        'MODULE_POSTMAN',
        'MODULE_KADROVIK',
        'MODULE_DOGADJAJI',
        'MODULE_ELMS',
        'MODULE_CRM',
        'MODULE_RP',
        'MODULE_PROCEDURE',
        'MODULE_PREUZIMANJE_PODATAKA',
        'MODULE_OTPREMNICE',
        'MODULE_TROSKOVNIK',
    ];

    public function fetchFromOrg(string $appCode): object
    {
        if (! config('legacy.orgapi.enabled')) {
            return (object) ['code' => 503, 'data' => 'ORG API je isključen (LEGACY_ORGAPI_ENABLED=false)'];
        }

        $server = rtrim((string) config('legacy.orgapi.server'), '/').'/';

        try {
            $response = Http::timeout((int) config('legacy.orgapi.timeout', 30))
                ->withoutVerifying()
                ->withToken((string) config('legacy.orgapi.token'))
                ->asMultipart()
                ->post($server.'getPackageForLicense', ['app' => $appCode]);
        } catch (ConnectionException $e) {
            return (object) ['code' => 500, 'data' => $e->getMessage()];
        }

        if ($response->status() !== 200) {
            return (object) ['code' => $response->status(), 'data' => $response->body()];
        }

        $json = $response->object();

        if (! is_object($json) || ! isset($json->code)) {
            return (object) ['code' => 500, 'data' => 'Neočekivan odgovor ORG API-ja'];
        }

        return $json;
    }

    /**
     * @param  array<int, object>  $packages
     * @return array<string, mixed> niz modula (isti kao session('licenseModule'))
     */
    public function storeInSession(array $packages): array
    {
        $result = $this->buildModules($packages);

        $last = $packages === [] ? null : $packages[array_key_last($packages)];

        Session::put('licenseModule', $result['modules']);
        Session::put('subscriberData', $last === null ? '' : sprintf(
            '%s, %s %s, %s %s',
            $last->ShortName ?? '',
            $last->StreetName ?? '',
            $last->StreetNumber ?? '',
            $last->PostCode ?? '',
            $last->municipalityName ?? '',
        ));
        Session::put('subcriberUniqueID', $last->UniqueID ?? null);
        Session::put('subcriberRegisteredNumber', $last->RegisteredNumber ?? null);
        Session::put('paragrafAIPackages', $result['paragrafAI']);
        Session::put('freePackage', $result['notFree'] === 0);

        if ($result['devModules']) {
            Session::put('devModules', true);
        }

        return $result['modules'];
    }

    /**
     * @param  array<string, mixed>|null  $modules  podrazumevano session('licenseModule')
     */
    public function hasAnyLoginModule(?array $modules = null): bool
    {
        $modules ??= session('licenseModule');

        if (! is_array($modules)) {
            return false;
        }

        foreach (self::LOGIN_REQUIRES_ANY as $module) {
            if ((int) ($modules[$module] ?? 0) === 1) {
                return true;
            }
        }

        return false;
    }

    /**
     * @param  array<int, object>  $packages
     * @return array{modules: array<string, mixed>, paragrafAI: array<int|string, array<string, mixed>>, notFree: int, devModules: bool}
     */
    private function buildModules(array $packages): array
    {
        $modules = [];

        foreach (self::MODULES as $module => $datesKey) {
            $modules[$module] = 0;
            $modules[$datesKey] = ['startDate' => null, 'endDate' => null];
        }

        $modules['MODULE_TOTAL'] = 0;
        $modules['MODULE_RP_SETTINGS'] = 0;

        $notFree = 0;
        $paragrafAI = [];
        $today = CarbonImmutable::today();

        $packageMap = self::PACKAGES
            + [(string) config('legacy.orgapi.crm_package_name', 'CRM') => ['MODULE_CRM', true, []]];

        $this->enable($modules, 'MODULE_KADROVIK_LITE', '2025-01-01', '2030-12-31');

        foreach ($packages as $package) {
            $definition = $packageMap[(string) ($package->packageName ?? '')] ?? null;

            if ($definition === null) {
                continue;
            }

            [$module, $paid, $extraModules] = $definition;

            $startDate = (string) ($package->startDate ?? '');
            $endDate = (string) ($package->endDate ?? '');

            if ($endDate === '') {
                continue;
            }

            $end = CarbonImmutable::parse($endDate)->startOfDay();
            $expirationDate = null;

            if ($end->greaterThan($today)) {
                if ($paid) {
                    $notFree = 1;
                }
            } elseif ($end->greaterThan($today->subMonth())) {
                $notFree = 1;
                $expirationDate = $end->addMonth()->format('Y-m-d');
            } else {
                continue;
            }

            if ($module === 'MODULE_PARAGRAF_AI') {
                $id = $package->org_package_id ?? count($paragrafAI);
                $paragrafAI[$id] = [
                    'id' => $id,
                    'packageName' => $package->packageName ?? null,
                    'startDate' => $startDate,
                    'endDate' => $endDate,
                    'kreditaPreostalo' => $package->KreditaPreostalo ?? null,
                    'brojKredita' => $package->BrojKredita ?? null,
                    'licenseID' => $package->licenseID ?? null,
                ];
            }

            foreach ([$module, ...$extraModules] as $enabledModule) {
                $this->enable($modules, $enabledModule, $startDate, $endDate, $expirationDate);
            }
        }

        $devModules = false;

        if (app()->environment('local')) {
            foreach ((array) config('legacy.dev_modules', []) as $devModule) {
                if (is_string($devModule) && isset(self::MODULES[$devModule])) {
                    $this->enable($modules, $devModule, $today->subYear()->format('Y-m-d'), $today->addYear()->format('Y-m-d'));
                    $devModules = true;
                }
            }
        }

        return [
            'modules' => $modules,
            'paragrafAI' => $paragrafAI,
            'notFree' => $notFree,
            'devModules' => $devModules,
        ];
    }

    /**
     * @param  array<string, mixed>  $modules
     */
    private function enable(array &$modules, string $module, string $startDate, string $endDate, ?string $expirationDate = null): void
    {
        $datesKey = self::MODULES[$module] ?? null;

        if ($datesKey === null) {
            return;
        }

        $current = is_array($modules[$datesKey] ?? null) ? ($modules[$datesKey]['endDate'] ?? null) : null;

        if ($current === null || $current < $endDate) {
            $modules[$datesKey] = ['startDate' => $startDate, 'endDate' => $endDate];

            if ($expirationDate !== null) {
                $modules[$datesKey]['expirationDate'] = $expirationDate;
            }
        }

        $modules[$module] = 1;
    }
}
