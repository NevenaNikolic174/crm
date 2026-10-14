<?php

namespace App\Legacy\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\ValidationException;

final class ChangeUserRoleFromCurrentModuleRequest extends FormRequest
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
        $isReturningFromExternalModule = $this->session()->has('user_role_while_change_process');

        return [
            'userRole' => [
                $isReturningFromExternalModule ? 'nullable' : 'required',
                'in:USER,ADMIN,SADMIN',
            ],
        ];
    }

    protected function failedValidation(Validator $validator): void
    {
        throw (new ValidationException($validator))->redirectTo(url()->previous());
    }
}
