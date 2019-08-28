<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddMaterialRequest extends FormRequest
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
            'material.part_no' => 'required|string|min:3|max:10',
            'material.description' => 'required|string|min:3|max:50',
            'material.type' => 'required|exists:ma_material_type,id'
        ];
    }

    public function messages()
    {
        return [
            'material.part_no.required' => 'Part No Is Required',
            'material.part_no.string' => 'Part No Should Be String',
            'material.part_no.min' => 'Part No Should Not Be Less Than 3',
            'material.part_no.max' => 'Part No Should Not Be Greater Than 10',
            'material.description.required'  => 'Description Is Required',
            'material.description.string'  => 'Description Should Be String',
            'material.description.min' => 'Description Should Not Be Less Than 3',
            'material.description.max' => 'Description Should Not Be Greater Than 50',
            'material.type.required' => 'Type Is Required',
            'material.type.exists' => 'Invalid Type',
        ];
    }
}
