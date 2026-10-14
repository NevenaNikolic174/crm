<?php

namespace App\Legacy\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

final class ChangeUserRoleFromExternalModuleRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    /**
     * @return array<string, list<string>>
     */
    public function rules(): array
    {
        return [
            'role' => ['required', 'in:USER,ADMIN,SADMIN'],
            'action' => ['required', 'string'],
            'redirectBackToUrl' => ['required', 'string'],
        ];
    }

    protected function failedValidation(Validator $validator): void
    {
        $redirectBackToUrl = (string) $this->input('redirectBackToUrl', '/');

        throw new HttpResponseException(redirect($redirectBackToUrl === '' ? '/' : $redirectBackToUrl));
    }
}
