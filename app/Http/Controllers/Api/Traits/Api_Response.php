<?php

namespace App\Http\Controllers\Api\Traits;

trait Api_Response
{
    public function apiResponse($data = null, $status = null, $msg = null)
    {
        return response([
            'Data' => $data,
            'Status' => $status,
            'Messages' => $msg
        ], $status);
    }
}
