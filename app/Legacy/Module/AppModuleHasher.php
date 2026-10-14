<?php

namespace App\Legacy\Module;

use App\Legacy\Encrypt\ModuleEncrypter;

final class AppModuleHasher
{
    /**
     * @param  array{route?: string}  $arr
     */
    public static function getLoginHash(array $arr = []): string
    {
        $data = [
            'licenseID' => session('licenseid'),
            'username' => session('username'),
            'hash_created' => time(),
        ];

        if (isset($arr['route'])) {
            $data['route'] = $arr['route'];
        }

        return app(ModuleEncrypter::class)->encrypt($data);
    }

    /**
     * @param  array{route?: string, module_url?: string}  $arr
     */
    public static function getRedirectHash(array $arr = []): string
    {
        $data = [
            'licenseID' => session('licenseid'),
            'username' => session('username'),
        ];

        if (isset($arr['route'])) {
            $data['route'] = $arr['route'];
        }

        if (isset($arr['module_url'])) {
            $data['module_url'] = $arr['module_url'];
        }

        return app(ModuleEncrypter::class)->encrypt($data);
    }
}
