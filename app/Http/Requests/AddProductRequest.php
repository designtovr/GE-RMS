<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddProductRequest extends FormRequest
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
            'product.part_no' => 'required|string|min:3|max:10',
            'product.description' => 'required|string|min:3|max:50',
            'product.type' => 'required|numeric|exists:ma_product_type,id',
        ];
    }

    public function messages()
    {
        return [
            'product.part_no.required' => 'Part No Is Required',
            'product.part_no.string' => 'Part No Should Be String',
            'product.part_no.min' => 'Part No Should Not Be Less Than 3',
            'product.part_no.max' => 'Part No Should Not Be Greater Than 10',
            'product.description.required' => 'Description Is Required',
            'product.description.string' => 'Description Should Be String',
            'product.description.min' => 'Description Should Not Be Less Than 3',
            'product.description.max' => 'Description Should Not Be Greater Than 50',
            'product.type.required' => 'Type Is Required',
            'product.type.numeric' => 'Type Should Be Number',
            'product.type.exists' => 'Type Is Invalid',
        ];
    }
}
