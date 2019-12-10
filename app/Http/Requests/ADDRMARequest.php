<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ADDRMARequest extends FormRequest
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
        //$rules['rma.ref_no'] = 'required|string|min:3|max:10';
        $rules['rma.id'] = 'nullable|exists:rma,id';
        //$rules['rma.gs_no'] = 'required|string|min:3|max:50';
        /*$rules['rma.act_reference'] = 'required|string|min:3|max:50';*/
        $rules['rma.date'] = 'required|date_format:d/m/Y';
        /*$rules['rma.desc_of_fault'] = 'required|string|min:3|max:100';
        $rules['rma.wbs'] = 'required|string|min:3|max:10';
        $rules['rma.field_volts_used'] = 'required|numeric|digits_between:0,1';
        $rules['rma.equip_failed_on_installation'] = 'required|numeric|digits_between:0,1';
        $rules['rma.equip_failed_on_service'] = 'required|numeric|digits_between:0,1';
        $rules['rma.update_version'] = 'required|numeric|digits_between:0,1';
        $rules['rma.return_in_case'] = 'required|numeric|digits_between:0,1';
        $rules['rma.how_long'] = 'required|string|min:3|max:25';*/
        $rules['rma.customer_address_id'] = 'required|exists:ma_customer,id';

        $rules['rma.invoice_info.end_customer'] = "required|string|min:1|max:50";
        $rules['rma.delivery_info.contact_person'] = "required|string|min:1|max:25";
        $rules['rma.delivery_info.address'] = "required|string|min:1|max:200";
        $rules['rma.delivery_info.email'] = "required|email";
        $rules['rma.delivery_info.tel_no'] = "required|numeric|min:1111111|max:999999999999999";
        $rules['rma.delivery_info.gst'] = "required|string|min:15|max:15";

        /*$rules['rma.unit_information'] = "required|array";*/

        /*$rules['rma.unit_information.*.model_id'] = "required|exists:ma_product,id";
        $rules['rma.unit_information.*.service_type'] = "required|digits_between:0,1";
        $rules['rma.unit_information.*.sw_version'] = "required|string|min:1|max:5";
        $rules['rma.unit_information.*.warrenty'] = "required|numeric|digits_between:0,1";*/

        /*$rules['rma.unit_information.*.serial_no'] = "required|array";
        $rules['rma.unit_information.*.serial_no.*'] = "required|string|min:3|max:10";*/

        $rules['pvs.*.id'] = 'required|exists:physical_verification,id';
        /*$rules['pvs.*.sw_version'] = 'required|string|min:1|max:5';*/
        /*$rules['pvs.*.service_type'] = 'required|numeric|digits_between:0,1';*/
        /*$rules['pvs.*.warrenty'] = 'required|numeric|digits_between:0,1';*/
        /*$rules['pvs.*.desc_of_fault'] = 'required|string|min:3|max:100';*/
        $rules['pvs.*.field_volts_used'] = 'required|numeric|digits_between:0,1';
        $rules['pvs.*.equip_failed_on_installation'] = 'required|numeric|digits_between:0,1';
        $rules['pvs.*.equip_failed_on_service'] = 'required|numeric|digits_between:0,1';
        /*$rules['pvs.*.how_long'] = 'required|string|min:1|max:25';*/
        
        return $rules;
    }

    public function attributes()
    {
        return [
            'rma.gs_no' => 'GS No',
            'rma.act_reference' => 'Act Reference',
            'rma.date' => 'Date',
            'rma.wbs' => 'Sales Order',
            'rma.field_volts_used' => 'Field Volts Used',
            'rma.equip_failed_on_installation' => 'Equipment Failed On Installation',
            'rma.equip_failed_on_service' => 'Equipment Failed On Service',
            'rma.update_version' => 'Update Firm',
            'rma.return_in_case' => 'Return In Case',
            'rma.how_long' => 'How Long',
            'rma.customer_address_id' => 'Customer Details',
            'rma.invoice_info.end_customer.end_customer' => 'End Customer',
            'rma.delivery_info.contact_name' => 'Delivery Contact Name',
            'rma.delivery_info.delivery_address' => 'Delivery Address',
            'rma.delivery_info.delivery_email' => 'Delivery Email',
            'rma.delivery_info.tel_no' => 'Delivery Tel No',
            'rma.delivery_info.gst_number' => 'Delivery GST',
            'rma.rma.unit_information' => 'Unit Information',
            'rma.unit_information.*.model_id' => 'Model Id',
            'rma.unit_information.*.service_type' => 'Service Type',
            'rma.unit_information.*.sw_version' => 'SW Version',
            'rma.unit_information.*.warrenty' => 'Warrenty',
            'pvs.*.id' => 'PV Id',
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
