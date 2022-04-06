<?php

namespace App\Http\Controllers;
use App\Http\Traits\ApiTrait;
use App\Http\Traits\DbTrait;

use Illuminate\Http\Request;

class ResolutionCodeController extends Controller
{
    use ApiTrait;
    use DbTrait;

    /**
     * returns a list of all priorities constant identifiers
     */
    public function index()
    {
        try {
            $resolution_codes = $this->getResolutionCodes();

            $message = 'SUCCESS';
            $remark = 'all resolution_codes fetched';
            $data = $resolution_codes;
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
