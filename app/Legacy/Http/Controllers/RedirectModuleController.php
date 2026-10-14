<?php

namespace App\Legacy\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Legacy\Encrypt\ModuleEncrypter;
use App\Legacy\Http\Concerns\LegacyResponses;
use App\Legacy\Module\AppModuleHasher;
use Symfony\Component\HttpFoundation\Response;

final class RedirectModuleController extends Controller
{
    use LegacyResponses;

    public function __construct(
        private readonly ModuleEncrypter $encrypter,
    ) {}

    public function index(string $hash): Response
    {
        $data = $this->encrypter->getData($hash);

        if ($data === false) {
            return $this->errorView('Link nije validan.');
        }

        if (($data['username'] ?? null) !== session('username')
            || (int) ($data['licenseID'] ?? 0) !== (int) session('licenseid')) {
            return $this->errorView('Link nije validan.');
        }

        $moduleUrl = (string) ($data['module_url'] ?? '');

        if ($moduleUrl === '') {
            return $this->errorView('URL do modula nije podešen.');
        }

        $loginHash = AppModuleHasher::getLoginHash(['route' => (string) ($data['route'] ?? '/')]);

        return redirect(rtrim($moduleUrl, '/').'/login/'.$loginHash);
    }
}
