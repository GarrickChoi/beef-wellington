<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CheckAddress extends FormRequest
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
            'getname' => 'required|between:2,8',
            'phone' => 'required|digits:11',
            's_province' => 'required',
            's_city' => 'required',
            's_county' => 'required',
            'detail_address' => 'required|min:2',
        ];
    }


    public function messages()
    {
        return [
            'getname.required' => '收件人未填',
            'getname.between' => '收件人输入2-8位的中文',
            'phone.required' => '电话号码没有填写',
            'phone.digits' => '请输入11位的电话号码',
            's_province.different' => '未选择省份',
            // 's_city.different' => '未选择地级市',
            // 's_county.different' => '未选择县级市',
            'detail_address.required' => '详细地址没有填写',
            'detail_address.min' => '请输入正确的详细地址',

        ];
    }
}
