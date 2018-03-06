<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CheckPwd extends FormRequest
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
            'password' => 'required|between:6,18|alpha_dash',
            'repassword' => 'required|between:6,18|alpha_dash',
            'oldpassword' => 'required|between:6,18|alpha_dash',
        ];
    }

    public function messages() 
    {
        return [
            'oldpassword.required' => '旧密码不能为空',
            'oldpassword.between' => '旧密码由6-18位字母、数字、破折号（ - ）以及下划线（ _ ）',
            'oldpassword.alpha_dash' => '旧密码由6-18位字母、数字、破折号（ - ）以及下划线（ _ ）',
            'password.required' => '新密码不能为空',
            'password.between' => '新密码由6-18位字母、数字、破折号（ - ）以及下划线（ _ ）',
            'password.alpha_dash' => '新密码由6-18位字母、数字、破折号（ - ）以及下划线（ _ ）',
            'repassword.required' => '确认密码不能为空',
            'repassword.between' => '确认密码由6-18位字母、数字、破折号（ - ）以及下划线（ _ ）',
            'repassword.alpha_dash' => '确认密码由6-18位字母、数字、破折号（ - ）以及下划线（ _ ）',
        ];
    }
}
