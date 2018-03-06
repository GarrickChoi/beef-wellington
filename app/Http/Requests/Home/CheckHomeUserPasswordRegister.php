<?php

namespace App\Http\Requests\Home;

use Illuminate\Foundation\Http\FormRequest;

class CheckHomeUserPasswordRegister extends FormRequest
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
     */
    public function rules()
    {
        return [
            
            'password' => [
                            'required',
                            'between:6,18',
                            'regex:/^(?![^A-Za-z]+$)(?![^0-9]+$)[\x21-x7e]+$/',
                            
                          ],

        ];
    }


    /**
    * 自定义错误信息
    */
    public function messages()
    {
        return [

                'password.required' => '请设置密码',
                'password.between' => '密码必须是6~18位字符',
                'password.regex' => '密码必须包含字母和数字',

        ];
    }
}
