<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddLocationRequest extends FormRequest
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
            'location.code' => 'required|string|min:3|max:10',
            'location.name' => 'required|string|min:3|max:20',
        ];
    }

    public function messages()
    {
        return [
            'location.code.required' => 'Location Code Is Required',
            'location.code.string' => 'Location Code Should Be String',
            'location.code.min' => 'Location Code Should Not Be Less Than 3',
            'location.code.max' => 'Location Code Should Not Be Greater Than 10',
            'location.name.required'  => 'Location Name Is Required',
            'location.name.string'  => 'Location Name Should Be String',
            'location.name.min' => 'Location Name Should Not Be Less Than 3',
            'location.name.max' => 'Location Name Should Not Be Greater Than 20',
        ];
    }
}
