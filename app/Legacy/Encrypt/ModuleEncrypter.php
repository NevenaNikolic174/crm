<?php

namespace App\Legacy\Encrypt;

use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Encryption\Encrypter;
use RuntimeException;
use Throwable;

final class ModuleEncrypter
{
    private Encrypter $encrypter;

    public function __construct()
    {
        $key = (string) config('legacy.key_module_encrypt');
        $cipher = (string) config('legacy.cipher', 'AES-256-CBC');

        if ($key === '') {
            throw new RuntimeException('KEY_MODULE_ENCRYPT nije podešen (config legacy.key_module_encrypt).');
        }

        if (! Encrypter::supported($key, $cipher)) {
            throw new RuntimeException('KEY_MODULE_ENCRYPT nema odgovarajuću dužinu za '.$cipher.' (očekuje se 32 znaka).');
        }

        $this->encrypter = new Encrypter($key, $cipher);
    }

    public function encrypt(mixed $data): string
    {
        return $this->encrypter->encrypt($data);
    }

    /**
     * @throws DecryptException
     */
    public function decrypt(string $payload): mixed
    {
        return $this->encrypter->decrypt($payload);
    }

    /**
     * @return array<string, mixed>|false
     */
    public function getData(string $hash): array|false
    {
        try {
            $data = $this->encrypter->decrypt($hash);
        } catch (Throwable) {
            return false;
        }

        return is_array($data) ? $data : false;
    }
}
