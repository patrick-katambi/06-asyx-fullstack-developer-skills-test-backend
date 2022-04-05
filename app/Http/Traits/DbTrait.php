<?php

namespace App\Http\Traits;

use App\Models\User;

trait DbTrait
{
    /**
     * identifying a user by email passed, since the email is unique
     * for all users
     */
    protected function queryRegisteredUser(string $email)
    {
        $registered_user = User::where('email', $email)->first();
        return $registered_user;
    }
}
