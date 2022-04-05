<?php

namespace App\Http\Traits;

use App\Models\User;
use Illuminate\Support\Facades\DB;

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


    /**
     * deleting a token associated with a particular user using passed id
     */

    protected function deleteUserToken(int $user_id) : int
    {
        $recordRemoved = DB::table('personal_access_tokens')->where('tokenable_id', $user_id)->delete();
        return $recordRemoved;
    }
}
