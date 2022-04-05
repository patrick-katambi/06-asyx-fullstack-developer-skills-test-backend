<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Traits\ApiTrait;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    use ApiTrait;

    public function userRegistration(Request $request)
    {
        # extracting the user credentials into a vairable
        $user_data = $request->user_data;

        # validating the user credentials if they conform to the rules
        # before performing any action on the $user_data
        $user_validator = Validator::make($user_data, $this->userRegistrationValidation());

        switch ($user_validator->fails()) {

                # if the user credentials conform to the rules
            case false:
                $user = $this->saveUser($user_data);
                $token = $this->generateUserToken($user, 'user');

                $message = 'SUCCESS';
                $remark = '';
                $data = ['user' => $user, 'token' => $token];
                $errors = null;

                return $this->apiResponse($message, $remark, $data, $errors);

                # if the user credentials dont conform to the rules
            case true:
                $message = 'FAILED';
                $remark = '';
                $data = null;
                $errors = $user_validator->errors();
                $statusCode = 400;

                return $this->apiResponse($message, $remark, $data, $errors, $statusCode);
        }
    }
}
