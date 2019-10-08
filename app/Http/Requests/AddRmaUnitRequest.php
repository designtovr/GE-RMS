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
            'pv.id' => 'required|exists:physical_verification,id',
            'pv.sw_version' => 'required|string|min:1|max:5',
            'pv.service_type'=> 'required|numeric|digits_between:0,1',
            'pv.warrenty' => 'required|numeric|digits_between:0,1',
            /*'pv.desc_of_fault' => 'required|string|min:3|max:100',*/
            'pv.field_volts_used' => 'required|numeric|digits_between:0,1',
            'pv.equip_failed_on_installation' => 'required|numeric|digits_between:0,1',
            'pv.equip_failed_on_service' => 'required|numeric|digits_between:0,1',
            'pv.how_long' => 'required|string|min:1|max:25',
        ];
    }

    public function attributes()
    {
        return [
            'rma.id' => 'RMA Id',
            'pv.id' => 'PV Id',
            'pv.desc_of_fault' => 'Description Of Fault',
            'pv.field_volts_used' => 'Field Volts Used',
            'pv.equip_failed_on_installation' => 'Equipment Failed On Installation',
            'pv.equip_failed_on_service' => 'Equipment Failed On Service',
            'pv.service_type' => 'Service Type',
            'pv.sw_version' => 'SW Version',
            'pv.warrenty' => 'Warrenty',
            'pv.how_long' => 'How Long',
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
