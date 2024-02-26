<?php

namespace App\Mixins;

class ResponseMixin
{

    public function successJson()
    {
        return function ($data, $status = true, $code = 200, $msg = 'success') {
            return [
                'result' => $status,
                'code' => $code,
                'data' => $data,
                'msg' => $msg
            ];
        };
    }

    public function errorJson()
    {
        return function ($data, $status = false, $code = 404, $msg = 'fail') {
            return [
                'result' => $status,
                'code' => $code,
                'data' => $data,
                'msg' => $msg
            ];
        };
    }
}
