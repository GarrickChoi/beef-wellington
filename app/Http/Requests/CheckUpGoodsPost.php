<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CheckUpGoodsPost extends FormRequest
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

    /**
     * 获取已定义的验证规则的错误消息。
     *
     * @return array
     */
    public function messages()
    {
        return [
            'goodsname.required' => 'The goodsname is not empty.',
            'goodsname.max'  => 'The length of goodsname is very long. ',
            'goodsname.unique' => 'The goodsname is already exists. ',
            'goodsname.alpha_dash' => 'The goodsnamem of format is not correct.',
            'brand.required' => 'The brand is does not exists.',
            'brand.integer' => 'The type of brand is error.',
            'type.required' => 'The type is does not exists.',
            'type.integer' => 'The type of type is error.',
            'color.required' => 'The color is does not exists.',
            'color.integer' => 'The type of integer error.',
            'ingredient.required' => 'The ingredient is does not exists.',
            'ingredient.integer' => 'The type of ingredient error.',
            'market.required' => 'The market is does not exists.',
            'market.integer' => 'The type of market error.',
            'style.required' => 'The style is does not exists.',
            'style.integer' => 'The type of style error.',
            'season.required' => 'The season is does not exists.',
            'season.integer' => 'The type of season error.',
            'objects.required' => 'The objects is does not exists.',
            'objects.integer' => 'The type of objects error.',
            'price.required' => 'The price is not null.',
            'price.integer' => 'The price are not numbers.',
            'store.required' => 'The store is not null.',
            'store.integer' => 'The store is not numbers.',
            'status.required' => 'The status is does not exists.',
            'status.integer' => 'The status of type error.',
        ];
    }
}
