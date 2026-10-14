<?php

namespace App\Legacy\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Legacy\Http\Requests\ChangeUserRoleFromCurrentModuleRequest;
use App\Legacy\Http\Requests\ChangeUserRoleFromExternalModuleRequest;
use App\Legacy\Services\UserRoleService;
use Illuminate\Http\RedirectResponse;

final class UserRoleController extends Controller
{
    public function __construct(
        private readonly UserRoleService $userRoleService,
    ) {}

    public function changeFromCurrentModule(ChangeUserRoleFromCurrentModuleRequest $request): RedirectResponse
    {
        return $this->userRoleService->changeFromCurrentModule($request->validated());
    }

    public function changeFromExternalModule(ChangeUserRoleFromExternalModuleRequest $request): RedirectResponse
    {
        $data = $request->validated();

        if ($request->hasSession() && $request->session()->has('loggedId')) {
            $this->userRoleService->changeFromExternalModule((string) $data['role']);
        }

        return redirect((string) $data['redirectBackToUrl']);
    }
}
