<?php

namespace App\Http\Controllers;

use App\Models\Priority;
use App\Http\Traits\ApiTrait;
use App\Http\Traits\DbTrait;

class PriorityController extends Controller
{
    use ApiTrait;
    use DbTrait;

    /**
     * returns a list of all priorities constant identifiers
     */
    public function index()
    {
        try {
            $priorities = $this->getPriorities();

            $message = 'SUCCESS';
            $remark = 'all priorities fetched';
            $data = $priorities;
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
