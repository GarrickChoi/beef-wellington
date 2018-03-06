<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CheckRoleAdd extends FormRequest
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
            'name' => 'min:2|max:30|unique:roles,name',
            'display_name' => 'min:2|max:30',
            'description' => 'max:100',
            'permission' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'name.max' => '角色名称长度不能大于30个字符',
            'name.min' => '角色名称长度不得少于2个字符',
            'name.unique' => '角色名已存在',
            'display_name.max' => '角色身份长度不能大于30个字符',
            'display_name.min' => '角色身份长度不得少于2个字符',
            'description.max' => '角色描述最多不能超过100字符',
            'permission.required' => '请选择角色的权限'
        ];
    }
}
