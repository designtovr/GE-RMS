<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddProductTypeRequest extends FormRequest
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
            'producttype.id' => 'nullable|exists:ma_product_type,id',
            'producttype.code' => 'required|string',
            'producttype.name' => 'required|string',
            'producttype.category' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'producttype.code.required' => 'Product Type Code Is Required',
            'producttype.code.string' => 'Product Type Code Should Be String',
            'producttype.code.min' => 'Product Type Code Should Not Be Less Than 3',
            'producttype.code.max' => 'Product Type Code Should Not Be Greater Than 10',
            'producttype.name.required'  => 'Product Type Name Is Required',
            'producttype.name.string'  => 'Product Type Name Should Be String',
            'producttype.name.min' => 'Product Type Name Should Not Be Less Than 3',
            'producttype.name.max' => 'Product Type Name Should Not Be Greater Than 20',
            'producttype.category.required'  => 'Product Category Is Required',
            'producttype.category.string'  => 'Product Type Name Should Be String',
            'producttype.description.required' => 'Description Is Required',
            'producttype.description.string' => 'Description Should Be String',
            'producttype.description.min' => 'Description Should Not Be Less Than 3',
            'producttype.description.max' => 'Description Should Not Be Greater Than 50',
        ];
    }
}
