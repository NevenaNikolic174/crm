<?php

namespace App\Legacy\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

final class SwitchModuleController extends Controller
{
    public function switchModul(Request $request): RedirectResponse
    {
        $query = $request->query();
        $module = (string) ($query['module'] ?? '');
        unset($query['module']);

        $second = array_key_first($query);
        $params = ['module' => $module] + ($second === null ? [] : [(string) $second => 1]);

        return redirect(rtrim((string) config('legacy.kancelarko_url'), '/').'/switchModul?'.http_build_query($params));
    }
}
