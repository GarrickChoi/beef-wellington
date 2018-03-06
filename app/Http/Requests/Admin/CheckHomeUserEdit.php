<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class CheckHomeUserEdit extends FormRequest
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
            'username' => 'required|unique:shop_home_user|min:2|max:30',
            'phone' => 'required|unique:shop_home_user|min:11|numeric',
            'email' => 'required|unique:shop_home_user|email',
            'role' => 'numeric',
            /*'pass' => 'min:6|max:18'*/
        ];
    }

    public function messages()
    {
        return [
            'username.required' => '用户名不能为空',
            'username.unique' => '用户名已存在',
            'username.min' => '用户名最少2个字符',
            'username' => '用户名最多30个字符',
            'phone.required' => '请输入手机号',
            'phone.unique' => '手机号已经被注册',
            'phone.required' => '请输入11位手机号',
            'phone.required' => '请输入纯数字的手机号',
            'email.request' => '请输入邮箱',
            'email.unique' => '邮箱已经被注册',
            'email.emailt' => '请输入正确的邮箱格式',
            /*'pass.min' => '密码最少是6位', 
            'pass.max' => '密码最多是18位', */
        ];
    }
}
