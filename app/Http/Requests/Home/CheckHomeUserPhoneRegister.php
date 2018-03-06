<?php

namespace App\Http\Requests\Home;

use Illuminate\Foundation\Http\FormRequest;

class CheckHomeUserPhoneRegister extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     * 
     * @return array
     * 
     */
    public function rules()
    {
        return [
            
            'phone' => [

                    'required',
                    'unique:shop_home_user',
                    'regex:/^1[34578]\d{9}$/',
                    ],
        ];
    }

    /**
    * 自定义错误信息
    * 
    * @return obj 
    */
    public function messages()
    {
        return [

            'phone.required' => '请输入手机号',
            'phone.regex' => '手机号格式有误',
            'phone.unique' => '该手机号已经被注册~',

        ];
    }

}
