<?php

namespace App\Http\Controllers\Common;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Gregwar\Captcha\CaptchaBuilder;

class Common extends Controller
{
     /**
     * 生成验证码
     *
     * @return codepic
     */

     public function buildCode() 
    {
        $builder = new CaptchaBuilder;
        $builder->build();

        //拿到验证码的字符串,并且存到session中.
        session(['code' => $builder->getPhrase()]);

        //生成图片
        header('Content-type: image/jpeg');
        $builder->output();
    }

}
