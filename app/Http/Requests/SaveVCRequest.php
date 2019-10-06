<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SaveVCRequest extends FormRequest
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
            'vc.id' => 'required|exists:physical_verification,id',
            'vc.clio_test' => 'required|boolean',
            'vc.rtd_test' => 'required|boolean',
            'vc.nic_test' => 'required|boolean',
            'vc.received_with_screws' => 'required|boolean',
            'vc.received_with_terminal' => 'required|boolean',
        ];
    }

    public function attributes()
    {
        return [
            'vc.id' => 'PV Id',
            'vc.clio_test' => 'CLIO Test',
            'vc.rtd_test' => 'RTD Test',
            'vc.nic_test' => 'NIC Test',
            'vc.received_with_screws' => 'Received With Screws',
            'vc.received_with_terminal' => 'Received With Screws',
        ];
    }

    public function messages()
    {
        return [
            'required' => ':attribute Required',
            'boolean' => 'Invalid :attribute',
        ];
    }
}
