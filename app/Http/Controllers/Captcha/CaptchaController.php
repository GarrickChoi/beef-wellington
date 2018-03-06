<?php

namespace App\Http\Controllers\Captcha;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Gregwar\Captcha\CaptchaBuilder;

class CaptchaController extends Controller
{
    //生成验证码
    public function buildCode()
    {
    	$builder = new CaptchaBuilder;
		$builder->build();

		//拿到验证码字符串,并且存到session中
		session(['captcha' => $builder->getPhrase()]);

		//将验证码生成一张图片
		header('Content-type: image/jpeg');
		$builder->output();

    }
}
