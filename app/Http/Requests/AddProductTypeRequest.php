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
            'producttype.code' => 'required|string|min:3|max:10',
            'producttype.name' => 'required|string|min:3|max:20',
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
        ];
    }
}