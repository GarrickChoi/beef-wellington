<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;

class CheckUserEdit extends FormRequest
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
    public function rules(Request $request)
    {
        $id = request()->input("id");

        if (empty($pwd) || empty($repwd)) {

            return [
               
               'name' => [
                    'min:2',
                    'max:10',
                    Rule::unique('users')->ignore($id),
                    ],

                'roles' => [
                    'required',
                    ],     
            ];

        } else {

            return [
               
               'name' => [
                    'min:2',
                    'max:10',
                    Rule::unique('users')->ignore($id),
                    ],

                'password' => [
                    'min:6',
                    'max:16',
                    ],
                'roles' => [
                    'required',
                    ],     
            ];
        }
    }

    public function messages()
    {
        return [
            'name.max' => '用户名长度不能大于10个字符',
            'name.min' => '用户名长度不得少于2个字符',
            'name.unique' => '用户名已存在',
            'psssword.required'  => '密码必填',
            'password.max'  => '密码长度不得大于16个字符串',
            'password.same'  => '两次密码输入不一致',
            'password.min'  => '密码长度不得少于6个字符串',
            'role.required' => '角色不得为空',
        ];
    }
}
