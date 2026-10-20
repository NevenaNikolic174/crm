<?php

namespace App\Legacy\Http\Concerns;

use Symfony\Component\HttpFoundation\Response;

trait LegacyResponses
{
    protected function errorView(string $message, int $status = 403): Response
    {
        return response()->view('legacy.switch_module_error', [
            'error_msg' => $message,
            'url' => config('legacy.kancelarko_url'),
        ], $status);
    }

    protected function externalRedirect(string $url): Response
    {
        return redirect($url);
    }
}
