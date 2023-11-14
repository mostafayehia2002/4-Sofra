<?php

namespace App\Traits;

trait GeneralResponse
{

    public function returnError($error,$statusCode)
    {
        return response()->json([
            'IsSuccess' => false,
            'Error' => $error,
            'Status'=>$statusCode,


        ]);
    }

    public function returnSuccessMessage($statusCode,$message='')
    {
        return response()->json( [
            'IsSuccess' => true,
            'Status'=>$statusCode,
            'Message'=>$message
        ]);
    }

    public function returnData($statusCode, $key, $value)
    {
        return response()->json([
            'IsSuccess' => true,
            'Status'=>$statusCode,
              $key => $value
        ]);
    }

}
