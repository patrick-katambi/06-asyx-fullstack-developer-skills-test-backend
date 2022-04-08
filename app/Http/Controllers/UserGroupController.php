<?php

namespace App\Http\Controllers;
use App\Http\Traits\ApiTrait;
use App\Http\Traits\DbTrait;

class UserGroupController extends Controller
{
    use ApiTrait;
    use DbTrait;

    /**
     * returns a list of all priorities constant identifiers
     */
    public function index()
    {
        try {
            $user_groups = $this->getUserGroups();

            $message = 'SUCCESS';
            $remark = 'all user_groups fetched';
            $data = $user_groups;
            $errors = null;
            $statusCode = 200;

            return $this->apiResponse($message, $remark, $data, $errors, $statusCode);

        } catch (\Throwable $th) {
            $message = 'FAILED';
            $remark = 'something went wrong';
            $data = null;
            $errors = $th;
            $statusCode = 500;

            return $this->apiResponse($message, $remark, $data, $errors, $statusCode);
        }
    }

    /**
     * returns a list of users belonging to a particular group / department
     */
    public function getUsers($group_id)
    {
        try {
            $users = $this->getUsersByGroupId($group_id);

            $message = 'SUCCESS';
            $remark = 'all users fetched';
            $data = $users;
            $errors = null;
            $statusCode = 200;

            return $this->apiResponse($message, $remark, $data, $errors, $statusCode);
        } catch (\Throwable $th) {
            $message = 'FAILED';
            $remark = 'something went wrong';
            $data = null;
            $errors = $th;
            $statusCode = 500;

            return $this->apiResponse($message, $remark, $data, $errors, $statusCode);
        }
    }
}
