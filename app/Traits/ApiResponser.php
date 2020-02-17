<?php

namespace App\Traits;

use Illuminate\Http\Response;

trait ApiResponser
{
    /**
     * Building success response
     * @param $data
     * @param int $code
     * @return \Illuminate\Http\JsonResponse
     */
    public function successResponse($data, $code = Response::HTTP_OK)
    {
        return \response()->json(['data' => $data], $code);
    }

    /**
     * Building error response
     * @param $message
     * @param int $code
     * @return \Illuminate\Http\JsonResponse
     */
    public function errorResponse($message, $code)
    {
        return \response()->json(['code' => $code, 'message' => $message], $code);
    }

}
