<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CheckUpEditPost extends FormRequest
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
            'goodsname' => 'required|max:255|unique:shop_goods,name|alpha_dash',
            'brand' => 'required|integer',
            'type' => 'required|integer',
            'color' => 'required|integer',
            'ingredient' => 'required|integer',
            'market' => 'required|integer',
            'Basic_style' => 'required|integer',
            'season' => 'required|integer',
            'objects' => 'required|integer',
            'price' => 'required|numeric',
            'store' => 'required|integer',
            'status' => 'required|integer'
        ];
    }
}
