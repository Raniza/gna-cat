<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;
    /**
     * Succes response method
     * 
     * @return \Illuminate\Response
     */
    public function successResponse($data, $message) {
        $response = [
            'success' => true,
            'data' => $data,
            'message' => $message
        ];
        return response()->json($response, 200);
    }
    /**
     * Succes response method
     * 
     * @return \Illuminate\Response
     */
    public function errorResponse($error, $errorMessage=[], $code = 404) {
        $response =[
            'success' => false,
            'message' => $error
        ];
        if (! empty($errorMessage)) {
            $response['data'] = $errorMessage;
        }
        return response()->json($response, $code);
    }
}
