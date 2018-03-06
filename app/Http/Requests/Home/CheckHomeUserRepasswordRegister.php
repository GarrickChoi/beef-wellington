<?php

namespace App\Http\Requests\Home;

use Illuminate\Foundation\Http\FormRequest;

class CheckHomeUserRepasswordRegister extends FormRequest
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
            
            'repassword' => "required|same:password",
        ];
    }

    /**
    * 自定义错误信息
    */
    public function messages()
    {
        return [

            'repassword.required' => '请再次输入密码',
            'repassword.same' => '两次输入密码不一致', 
        ];
    }
}
