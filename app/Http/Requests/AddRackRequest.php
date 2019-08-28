<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddRackRequest extends FormRequest
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
            'rack.code' => 'required|string|min:3|max:10',
            'rack.name' => 'required|string|min:3|max:20',
            'rack.type' => 'required|numeric|exists:ma_rack_type,id',
        ];
    }

    public function messages()
    {
        return [
            'rack.code.required' => 'Rack Code Is Required',
            'rack.code.string' => 'Rack Code Should Be String',
            'rack.code.min' => 'Rack Code Should Not Be Less Than 3',
            'rack.code.max' => 'Rack Code Should Not Be Greater Than 10',
            'rack.name.required'  => 'Rack Name Is Required',
            'rack.name.string'  => 'Rack Name Should Be String',
            'rack.name.min' => 'Rack Name Should Not Be Less Than 3',
            'rack.name.max' => 'Rack Name Should Not Be Greater Than 20',
            'rack.type.required'  => 'Rack Type Is Required',
            'rack.type.numeric'  => 'Rack Type Should Be Numeric',
            'rack.type.exists' => 'Invalid Rack Type',
        ];
    }
}
