<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SaveSiteCardRMARequest extends FormRequest
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
            'sitecardrma.id' => 'nullable|exists:rma,id',
            'sitecardrma.unit_information.*.model' => 'required|array',
            'sitecardrma.unit_information.*.serial_no' => 'required',
            'sitecardrma.unit_information.*.sw_version' => 'required',
        ];
    }

    public function attributes()
    {
        return [
            'sitecardrma.id' => 'Id',
            'sitecardrma.unit_information.*.model' => 'Model',
            'sitecardrma.unit_information.*.serial_no' => 'Serial No',
            'sitecardrma.unit_information.*.sw_version' => 'SW Version',
        ];
    }

    public function messages()
    {
        return [
            'required' => ':attribute is Required',
            'exists' => 'Invalid :attribute',
        ];
    }
}
