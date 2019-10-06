<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SaveTestResultRequest extends FormRequest
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
            'pvids' => 'required|array|exists:physical_verification,id',
            'test.result' => 'required|digits_between:0,1'
        ];
    }

    public function attributes()
    {
        return [
            'pvids' => 'PV Id',

        ];
    }

    public function messages()
    {
        return [
            'required' => ':attribute Required',
            'array' => 'Invalid :attribute',
            'exists' => 'Invalid :attribute',
            'digits_between' => 'Invalid :attribute',
        ];
    }
}
