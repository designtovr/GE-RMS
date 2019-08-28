<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddMaterialTypeRequest extends FormRequest
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
            'materialtype.code' => 'required|string|min:3|max:10',
            'materialtype.name' => 'required|string|min:3|max:20',
        ];
    }

    public function messages()
    {
        return [
            'materialtype.code.required' => 'Material Code Is Required',
            'materialtype.code.string' => 'Material Code Should Be String',
            'materialtype.code.min' => 'Material Code Should Not Be Less Than 3',
            'materialtype.code.max' => 'Material Code Should Not Be Greater Than 10',
            'materialtype.name.required'  => 'Material Name Is Required',
            'materialtype.name.string'  => 'Material Name Should Be String',
            'materialtype.name.min' => 'Material Name Should Not Be Less Than 3',
            'materialtype.name.max' => 'Material Name Should Not Be Greater Than 20',
        ];
    }
}
