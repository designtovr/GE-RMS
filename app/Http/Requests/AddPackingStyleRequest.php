<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddPackingStyleRequest extends FormRequest
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
            'packingstyle.code' => 'required|string|min:3|max:10',
            'packingstyle.name' => 'required|string|min:3|max:20',
        ];
    }

    public function messages()
    {
        return [
            'packingstyle.code.required' => 'Packing Style Code Is Required',
            'packingstyle.code.string' => 'Packing Style Code Should Be String',
            'packingstyle.code.min' => 'Packing Style Code Should Not Be Less Than 3',
            'packingstyle.code.max' => 'Packing Style Code Should Not Be Greater Than 10',
            'packingstyle.name.required'  => 'Packing Style Name Is Required',
            'packingstyle.name.string'  => 'Packing Style Name Should Be String',
            'packingstyle.name.min' => 'Packing Style Name Should Not Be Less Than 3',
            'packingstyle.name.max' => 'Packing Style Name Should Not Be Greater Than 20',
        ];
    }
}
