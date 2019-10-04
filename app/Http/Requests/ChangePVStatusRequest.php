<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ChangePVStatusRequest extends FormRequest
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
            'status' => 'required|string'
        ];
    }

    public function attributes()
    {
        return [
            'pvids' => 'PV ID',
            'status' => 'Status'
        ];
    }

    public function messages()
    {
        return [
            'required' => ':attribute Required',
            'array' => ':attribute Must Be An Array',
            'exists' => 'Invalid :attribute',
            'string' => ':attribute Must Be String'
        ];
    }
}
