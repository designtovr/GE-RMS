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
            'product.id' => 'nullable|exists:ma_product,id',
            'product.part_no' => 'required',
            'product.type' => 'required|exists:ma_product_type,id',
        ];
    }

    public function messages()
    {
        return [
            'product.id.exists' => 'Invalid Product Id',
            'product.part_no.required' => 'Part No Is Required',
            'product.part_no.string' => 'Part No Should Be String',
            'product.part_no.min' => 'Part No Should Not Be Less Than 3',
            'product.part_no.max' => 'Part No Should Not Be Greater Than 50',
            'product.part_no.unique' => 'Part No Already Exists',
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
