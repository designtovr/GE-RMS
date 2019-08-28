<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddManufactureRequest extends FormRequest
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
            'manufacture.code' => 'required|string|min:3|max:10',
            'manufacture.name' => 'required|string|min:3|max:20',
        ];
    }

    public function messages()
    {
        return [
            'manufacture.code.required' => 'Manufacture Code Is Required',
            'manufacture.code.string' => 'Manufacture Code Should Be String',
            'manufacture.code.min' => 'Manufacture Code Should Not Be Less Than 3',
            'manufacture.code.max' => 'Manufacture Code Should Not Be Greater Than 10',
            'manufacture.name.required'  => 'Manufacture Name Is Required',
            'manufacture.name.string'  => 'Manufacture Name Should Be String',
            'manufacture.name.min' => 'Manufacture Name Should Not Be Less Than 3',
            'manufacture.name.max' => 'Manufacture Name Should Not Be Greater Than 20',
        ];
    }
}
