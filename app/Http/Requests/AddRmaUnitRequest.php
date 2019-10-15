<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddRmaUnitRequest extends FormRequest
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
            'rma.id' => 'required|exists:rma,id',
            'pvs.*.id' => 'required|exists:physical_verification,id',
            'pvs.*.warrenty' => 'required|numeric|digits_between:0,1',
            'pvs.*.field_volts_used' => 'required|numeric|digits_between:0,1',
            'pvs.*.equip_failed_on_installation' => 'required|numeric|digits_between:0,1',
            'pvs.*.equip_failed_on_service' => 'required|numeric|digits_between:0,1',
        ];
    }

    public function attributes()
    {
        return [
            'rma.id' => 'RMA Id',
            'pvs.*.id' => 'PVs Id',
            'pvs.*.desc_of_fault' => 'Description Of Fault',
            'pvs.*.field_volts_used' => 'Field Volts Used',
            'pvs.*.equip_failed_on_installation' => 'Equipment Failed On Installation',
            'pvs.*.equip_failed_on_service' => 'Equipment Failed On Service',
            'pvs.*.service_type' => 'Service Type',
            'pvs.*.sw_version' => 'SW Version',
            'pvs.*.warrenty' => 'Warrenty',
            'pvs.*.how_long' => 'How Long',
        ];
    }

    public function messages()
    {
        return [
            'required' => ' :attribute is Required',
            'min' => ' :attribute Should Not Be Less Than :min',
            'max' => ' :attribute Should Not Be Greater Than :max',
            'string' => ' :attribute Should Be String',
            'numeric' => ' :attribute Should Be Number',
            'digits_between' => 'Invalid :attribute',
            'exists' => 'Invalid :attribute',
            'array' => ':attribute Should Be Array'
        ];
    }
}
