<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddRackTypeRequest extends FormRequest
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
            'racktype.name' => 'required|string|min:3|max:20',
        ];
    }

    public function messages()
    {
        return [
            'racktype.name.required'  => 'Rack Type Name Is Required',
            'racktype.name.string'  => 'Rack Type Should Be String',
            'racktype.name.min' => 'Rack Type Should Not Be Less Than 3',
            'racktype.name.max' => 'Rack Type Should Not Be Greater Than 20',
        ];
    }
}
