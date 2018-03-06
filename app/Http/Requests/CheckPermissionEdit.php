<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;

class CheckPermissionEdit extends FormRequest
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
        return [
           
           'name' => [
                'min:2',
                'max:30',
                Rule::unique('permissions')->ignore($id),
                ],

            'display_name' => [
                'min:2',
                'max:30',
                ],

            'description' => [
                'max:100'
                ],        
        ];
    }

    public function messages()
    {
        return [
            'name.max' => '权限名称长度不能大于30个字符',
            'name.min' => '权限名称长度不得少于2个字符',
            'name.unique' => '权限名已存在',
            'display_name.max' => '权限规则长度不能大于30个字符',
            'display_name.min' => '权限规则长度不得少于2个字符',
            'description.max' => '权限描述最多不能超过100字符',
        ];
    }
}
