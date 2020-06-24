<?php


namespace App\Http\Controllers\Api;

use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    const CODE_SUCCESS = 1000;
    const CODE_ERROR = 999;
    const MODE_OUTPUT_DEV = JSON_UNESCAPED_UNICODE|JSON_PRETTY_PRINT;
    const MODE_OUTPUT_PROD = JSON_UNESCAPED_UNICODE;

    protected function Success($data = [],$msg = 'ok') {
        $mode = env('APP_DEBUG',true) ? self::MODE_OUTPUT_DEV : self::MODE_OUTPUT_PROD;
        $result = [
            'code' => self::CODE_SUCCESS,
            'msg'  => $msg,
            'data' => $data
        ];
        return response()->json($result,200,[],$mode);
    }


    protected function Error($data = [], $msg = 'error') {
        $result = [
            'code' => self::CODE_ERROR,
            'msg'  => $msg,
            'data' => $data
        ];
        return response()->json($result);
    }
}
