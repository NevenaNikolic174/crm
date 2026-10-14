<?php

namespace App\Legacy\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

final class LoginRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    protected function prepareForValidation(): void
    {
        if (! $this->isChoosingLicense()) {
            return;
        }

        $old = (array) $this->session()->get('OldRequest', []);

        $this->merge([
            'username' => $old['username'] ?? $this->input('username'),
            'remember' => $old['remember'] ?? $this->input('remember'),
        ]);
    }

    /**
     * @return array<string, list<string>>
     */
    public function rules(): array
    {
        return [
            'username' => ['required', 'string', 'max:191'],
            'password' => [$this->isChoosingLicense() ? 'nullable' : 'required', 'string'],
            'licenseCompany' => [$this->isChoosingLicense() ? 'required' : 'nullable', 'integer', 'min:1'],
        ];
    }

    /**
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'username.required' => 'Unesite korisničko ime.',
            'password.required' => 'Unesite lozinku.',
            'licenseCompany.required' => 'Izaberite licencu.',
            'licenseCompany.integer' => 'Izaberite licencu.',
            'licenseCompany.min' => 'Izaberite licencu.',
        ];
    }

    public function username(): string
    {
        return trim((string) $this->input('username'));
    }

    public function password(): string
    {
        return (string) $this->input('password');
    }

    public function licenseId(): ?int
    {
        $id = $this->integer('licenseCompany');

        return $id > 0 ? $id : null;
    }

    public function remember(): bool
    {
        return $this->boolean('remember');
    }

    public function isChoosingLicense(): bool
    {
        return $this->has('chooseLicense');
    }
}
