<?php

namespace App\Http\Controllers\Common;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ajaxReturnJsonContent extends Controller
{
    /**
     * 设置返回结果
     * @param  [bool] $bool    [需要判断的值]
     * @param  [type] $success [true时返回的值]
     * @param  [type] $fail    [false时返回的值]
     * @return [array]  [返回用于返回给视图的数据]
     * @author [lzk] <[13760697742@163.com]>
     */
    public static function returnVal($data, $success, $fail)
    {
        if ($data == true) {
            return [
                'code' => 1,
                'msg' => $success,
                'data' => $data,
            ];
        } else {
            return [
                'code' => 2,
                'msg' => $fail,
            ];
        }
    }
}
