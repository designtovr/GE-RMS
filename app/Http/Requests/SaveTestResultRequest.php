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
            'test.result' => 'required|numeric|min:-1|max:1'
        ];
    }

    public function attributes()
    {
        return [
            'pvids' => 'PV Id',
            'test.result' => 'Result'
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
