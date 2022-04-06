<?php

namespace App\Http\Controllers;
use App\Http\Traits\ApiTrait;
use App\Http\Traits\DbTrait;

use Illuminate\Http\Request;

class TicketController extends Controller
{
    use ApiTrait;
    use DbTrait;

    /**
     * returns a list of all priorities constant identifiers
     */
    public function index()
    {
        try {
            $tickets = $this->getAllTickets();

            $message = 'SUCCESS';
            $remark = 'all tickets fetched';
            $data = $tickets;
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
