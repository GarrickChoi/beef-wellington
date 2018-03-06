<?php

namespace App\Http\Requests\Home;

use Illuminate\Foundation\Http\FormRequest;

class CheckHomeUserRegister extends FormRequest
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

            'username' => [
                            'unique:shop_home_user',
                            'required',
                            'between:2,20',
                            'regex:/^[\x{4e00}-\x{9fa5}A-Za-z0-9_]*$/u'
                          ],

            

        ];
    }

    /**
    * 自定义错误信息
    */
    public function messages()
    {
        return [

                'username.required' => '请输入用户名',
                'username.unique' => '此用户名已注册',
                'username.between' => '用户名必须是2~20位字符',
                'username.regex' => '用户名格式错误',


            
        ];
    }
}
