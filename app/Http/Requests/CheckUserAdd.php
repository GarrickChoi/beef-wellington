<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CheckUserAdd extends FormRequest
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
            'name' => 'min:2|unique:users,name|max:10',
            'password' => 'required|min:6|same:repassword|max:16',
            'roles' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'name.max' => '用户名长度不能大于10个字符',
            'name.min' => '用户名长度不得少于2个字符',
            'name.unique' => '用户名已存在',
            'password.required'  => '密码必填',
            'password.max'  => '密码长度不得大于16个字符串',
            'password.same'  => '两次密码输入不一致',
            'password.min'  => '密码长度不得少于6个字符串',
            'role.required' => '角色不得为空',
        ];
    }


}
