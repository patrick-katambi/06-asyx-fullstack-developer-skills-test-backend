<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Traits\ApiTrait;
use App\Http\Traits\DbTrait;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    use ApiTrait;
    use DbTrait;

    /**
     * user registration route controller method
     */
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
                $statusCode = 200;

                return $this->apiResponse($message, $remark, $data, $errors, $statusCode);
        }
    }


    /**
     * user login route controller method
     */

    public function userLogin(Request $request)
    {
        # extracting the user credentials into a vairable
        $user_data = $request->user_data;

        # validating the user credentials if they conform to the rules
        # before performing any action on the $user_data
        $user_validator = Validator::make($user_data, $this->userLoginValidation());

        switch ($user_validator->fails()) {

            case false:
                # if the user credentials conform to the rules

                # finding user by email
                $user = $this->queryRegisteredUser($user_data['email']);

                switch ($user) {

                    case true:
                        # if a user is found
                        $token = $this->generateUserToken($user, 'user');

                        $message = 'SUCCESS';
                        $remark = '';
                        $data = ['user' => $user, 'token' => $token];
                        $errors = null;

                        return $this->apiResponse($message, $remark,  $data, $errors);

                    case null:
                        # if a user doent exist
                        $message = 'FAILED';
                        $remark = '';
                        $data = null;
                        $errors = "user with email < {$user_data['email']} > does not exist";
                        $statusCode = 200;

                        return $this->apiResponse($message, $remark, $data, $errors, $statusCode);
                }
                break;

            case true:
                # if the user credentials dont conform to the rules

                $message = 'FAILED';
                $remark = '';
                $data = null;
                $errors = $user_validator->errors();
                $statusCode = 200;

                return $this->apiResponse($message, $remark, $data, $errors, $statusCode);
        }
    }


    /**
     * in order to logout, we will use the user id passed in the request to
     * delete its corresponding token record in the personal_access_tokens table
     */
    public function logOut(Request $request, $user_id)
    {
        try {
            /**
             * $this->deleteUserToken($user_id)
             * --> returns '1' if the record is deleted successfully
             * --> returns '0' if the record couldnot be deleted or does not exist
             */
            $requestToken = $request->bearerToken();
            $record_removed = $this->deleteUserToken($user_id);

            switch ($record_removed) {
                case 1:
                    $message = 'SUCCESS';
                    $remark = 'logged out successfully';
                    $data = ['record_removed' => $record_removed];
                    $errors = null;

                    return $this->apiResponse($message, $remark,  $data, $errors);

                case 0:
                    $message = 'FAILED';
                    $remark = 'make sure the user_id is valid';
                    $data = ['record_removed' => $record_removed];
                    $errors = null;
                    $statusCode = 400;

                    return $this->apiResponse($message, $remark, $data, $errors, $statusCode);
            }
        }
        /**
         * if any error due to code logic occurs
         */
        catch (\Throwable $th) {
            $message = 'FAILED';
            $remark = 'Server error';
            $data = null;
            $errors = $th;
            $statusCode = 400;

            return $this->apiResponse($message, $remark, $data, $errors, $statusCode);
        }
    }


    /**
     * get all users under a particular user group
     */

    public function getUsersByUserGroup($user_group_id)
    {
        try {
            $user_group = $this->getUserGroupById($user_group_id);
            $users = $this->getUsersByUserGroupId($user_group_id);

            $message = 'SUCCESS';
            $remark = 'fetched all users under the ' . $user_group->name . ' user group';
            $data = $users;
            $errors = null;
            $statusCode = 200;

            return $this->apiResponse($message, $remark, $data, $errors, $statusCode);
        } catch (\Throwable $th) {
            $message = 'FAILED';
            $remark = 'Server error';
            $data = null;
            $errors = $th;
            $statusCode = 500;

            return $this->apiResponse($message, $remark, $data, $errors, $statusCode);
        }
    }

    public function tokenizer(Request $request) {
        return response(['token' => $request->bearerToken()]);
    }
}
