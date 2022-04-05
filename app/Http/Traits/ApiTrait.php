<?php

namespace App\Http\Traits;

use App\Models\User;

trait ApiTrait
{
    /**
     * validation arrays used in making sure user
     * requests have data that comforms to these rules
     */

    protected function userRegistrationValidation(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ];
    }

    protected function userLoginValidation(): array
    {
        return [
            'email' => ['required', 'string', 'email', 'max:255'],
            'password' => ['required', 'string', 'min:8'],
        ];
    }
}
