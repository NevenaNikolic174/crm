<?php

namespace App\Legacy\Module;

final class AppModuleChecker
{
    public function check(string $module): bool
    {
        $sessionModules = session('licenseModule');
        $sessionModules = is_array($sessionModules) ? $sessionModules : [];

        foreach (explode('#', $module) as $single) {
            if ($this->hasModule($sessionModules, $single)) {
                return true;
            }
        }

        return false;
    }

    /**
     * @param  array<string, mixed>  $sessionModules
     */
    private function hasModule(array $sessionModules, string $module): bool
    {
        $enabled = (int) ($sessionModules[$module] ?? 0) === 1
            || (int) ($sessionModules[AppModule::MODULE_TOTAL] ?? 0) === 1;

        if (! $enabled) {
            return false;
        }

        return in_array($module, AppModule::getAllowedModules($module), true);
    }
}
