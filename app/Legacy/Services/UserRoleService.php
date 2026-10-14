<?php

namespace App\Legacy\Services;

use App\Legacy\Encrypt\ModuleEncrypter;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Throwable;

final class UserRoleService
{
    private const MODULE_KANCELARKO = 'MODULE_KANCELARKO';

    private const EXTERNAL_MODULE_CHANGE_ROLE = 'CHANGE_ROLE';

    private const SESSION_KEY_CURRENT_ROLE = 'user_role_while_change_process';

    private const SESSION_KEY_PROCESSED_MODULES = 'user_role_change_processed_modules';

    private const SESSION_KEY_ORIGINAL_URL = 'original_redirect_url';

    public function __construct(
        private readonly ModuleEncrypter $hasher,
    ) {}

    /**
     * @param  array<string, mixed>  $attributes  mora da sadrži 'userRole'
     */
    public function changeFromCurrentModule(array $attributes): RedirectResponse
    {
        $this->initializeRoleChangeState($attributes);

        $role = (string) Session::get(self::SESSION_KEY_CURRENT_ROLE);

        $this->persistRoleInCurrentModule($role);

        if (! Session::has(self::SESSION_KEY_PROCESSED_MODULES)) {
            Session::put(self::SESSION_KEY_ORIGINAL_URL, url()->previous());
        }

        $processedModules = (array) Session::get(self::SESSION_KEY_PROCESSED_MODULES, []);

        foreach ((array) config('legacy.role_change_modules', []) as $externalModule => $externalModuleUrl) {
            $externalModule = (string) $externalModule;

            if (in_array($externalModule, $processedModules, true)
                || ($externalModule !== self::MODULE_KANCELARKO && ! checkmodule($externalModule))) {
                continue;
            }

            $baseUrl = (string) config('legacy.'.(string) $externalModuleUrl);

            $processedModules[] = $externalModule;
            Session::put(self::SESSION_KEY_PROCESSED_MODULES, $processedModules);

            if ($baseUrl === '') {
                Log::warning("External module {$externalModule} URL not configured, skipping");

                continue;
            }

            if (app()->environment('local') && ! $this->isExternalModuleReachable($baseUrl)) {
                Log::warning("External module {$externalModule} at {$baseUrl} is not reachable, skipping");

                continue;
            }

            return redirect($this->buildExternalModuleRedirectUrl($role, $baseUrl));
        }

        return $this->completeRoleChange();
    }

    public function changeFromExternalModule(string $role): void
    {
        $this->persistRoleInCurrentModule($role);
    }

    /**
     * @param  array<string, mixed>  $attributes
     */
    private function initializeRoleChangeState(array $attributes): void
    {
        if (Session::has(self::SESSION_KEY_CURRENT_ROLE)) {
            return;
        }

        Session::put(self::SESSION_KEY_CURRENT_ROLE, $attributes['userRole']);
    }

    private function persistRoleInCurrentModule(string $role): void
    {
        Session::put('userRole', $role);
    }

    private function buildExternalModuleRedirectUrl(string $role, string $baseUrl): string
    {
        $action = $this->hasher->encrypt(self::EXTERNAL_MODULE_CHANGE_ROLE);

        return rtrim($baseUrl, '/').'/external-modules/users/change-role?'.http_build_query([
            'role' => $role,
            'action' => $action,
            'redirectBackToUrl' => url()->current(),
        ]);
    }

    private function isExternalModuleReachable(string $baseUrl): bool
    {
        try {
            $response = Http::timeout(2)
                ->connectTimeout(1)
                ->withoutVerifying()
                ->get($baseUrl);

            return $response->status() >= 200 && $response->status() < 400;
        } catch (Throwable $e) {
            Log::warning("Failed to check external module reachability: {$e->getMessage()}");

            return false;
        }
    }

    private function completeRoleChange(): RedirectResponse
    {
        $originalUrl = (string) Session::get(self::SESSION_KEY_ORIGINAL_URL, '/');

        Session::forget([
            self::SESSION_KEY_PROCESSED_MODULES,
            self::SESSION_KEY_ORIGINAL_URL,
            self::SESSION_KEY_CURRENT_ROLE,
        ]);

        return redirect($originalUrl);
    }
}
