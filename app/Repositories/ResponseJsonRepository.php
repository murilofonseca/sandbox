<?php

namespace App\Repositories;

class ResponseJsonRepository
{

    public function responseJson($status, $rotaApi, $response, $statusCode)
    {
        $response =  array(
            $status => [
                $rotaApi => $response
            ]
        );

        return response()->json($response, $statusCode);
    }
}
