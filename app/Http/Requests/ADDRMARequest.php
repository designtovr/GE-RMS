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
        $rules['rma.gs_no'] = 'required|string|min:3|max:10';
        $rules['rma.act_reference'] = 'required|string|min:3|max:10';
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

        $rules['rma.delivery_info.contact_name'] = "required|string|min:3|max:25";
        $rules['rma.delivery_info.delivery_address'] = "required|string|min:3|max:100";
        $rules['rma.delivery_info.delivery_email'] = "required|email";
        $rules['rma.delivery_info.tel_no'] = "required|numeric|min:1111111|max:999999999999999";
        $rules['rma.delivery_info.gst_number'] = "required|string|min:15|max:15";

        $rules['rma.unit_information'] = "required|array";

        /*$rules['rma.unit_information.*.model_id'] = "required|exists:ma_product,id";
        $rules['rma.unit_information.*.service_type'] = "required|digits_between:0,1";
        $rules['rma.unit_information.*.sw_version'] = "required|string|min:1|max:5";
        $rules['rma.unit_information.*.warrenty'] = "required|numeric|digits_between:0,1";*/

        /*$rules['rma.unit_information.*.serial_no'] = "required|array";
        $rules['rma.unit_information.*.serial_no.*'] = "required|string|min:3|max:10";*/

        $rules['pvs.*.id'] = 'required|exists:physical_verification,id';
        $rules['pvs.*.sw_version'] = 'required|string|min:1|max:5';
        $rules['pvs.*.service_type'] = 'required|numeric|digits_between:0,1';
        $rules['pvs.*.warrenty'] = 'required|numeric|digits_between:0,1';
        $rules['pvs.*.desc_of_fault'] = 'required|string|min:3|max:100';
        /*$rules['pvs.*.wbs'] = 'required|string|min:3|max:10';*/
        $rules['pvs.*.field_volts_used'] = 'required|numeric|digits_between:0,1';
        $rules['pvs.*.equip_failed_on_installation'] = 'required|numeric|digits_between:0,1';
        $rules['pvs.*.equip_failed_on_service'] = 'required|numeric|digits_between:0,1';
        $rules['pvs.*.how_long'] = 'required|string|min:1|max:25';
        
        return $rules;
    }

    public function attributes()
    {
        return [
            'rma.gs_no' => 'GS No',
            'rma.act_reference' => 'Act Reference',
            'rma.date' => 'Date',
            'rma.desc_of_fault' => 'Description Of Fault',
            'rma.wbs' => 'Sales Order',
            'rma.field_volts_used' => 'Field Volts Used',
            'rma.equip_failed_on_installation' => 'Equipment Failed On Installation',
            'rma.equip_failed_on_service' => 'Equipment Failed On Service',
            'rma.update_version' => 'Update Firm',
            'rma.return_in_case' => 'Return In Case',
            'rma.how_long' => 'How Long',
            'rma.customer_address_id' => 'Customer Details',
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
            'rma.unit_information.*.serial_no' => 'Serial Number',
            'rma.unit_information.*.serial_no.*' => 'Serial Number',
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
        /*$messages['rma.gs_no.required'] = "GS No is Required";
        $messages['rma.gs_no.string'] = "GS No Should Be String";
        $messages['rma.gs_no.min'] = "GS No Should Not Be Less Than 3";
        $messages['rma.gs_no.max'] = "GS No Should Not Be Greater Than 10";
        $messages['rma.date.required'] = "Date is Required";
        $messages['rma.date.date_format'] = "Invalid Date Format";
        $messages['rma.desc_of_fault.required'] = "Description Of Fault Is Required";
        $messages['rma.desc_of_fault.string'] = "Description Of Fault Should Be String";
        $messages['rma.desc_of_fault.min'] = "Description Of Fault Should Not Be Less Than 3";
        $messages['rma.desc_of_fault.max'] = "Description Of Fault Should Not Be Greater Than 10";
        $messages['rma.wbs.required'] = "Sales Order Is Required";
        $messages['rma.wbs.string'] = "Sales Order Should Be String";
        $messages['rma.wbs.min'] = "Sales Order Should Not Be Less Than 3";
        $messages['rma.wbs.max'] = "Sales Order Should Not Be Greater Than 10";
        $messages['rma.field_volts_used.required'] = "Field Volts Used Is Required";
        $messages['rma.field_volts_used.digits_between'] = "Invalid Field Volts Used Data";
        $messages['rma.equip_failed_on_installation.required'] = "Equipment Failed On Installation Is Required";
        $messages['rma.equip_failed_on_installation.digits_between'] = "Invalid Equipment Failed On Installation Data";
        $messages['rma.equip_failed_on_service.required'] = "Equipment Failed On Service Is Required";
        $messages['rma.equip_failed_on_service.digits_between'] = "Invalid Equipment Failed On Service Data";
        $messages['rma.update_version.required'] = "Update Firm Is Required";
        $messages['rma.update_version.digits_between'] = "Invalid Update Firm Data";
        $messages['rma.return_in_case.required'] = "Return In Case Is Required";
        $messages['rma.return_in_case.digits_between'] = "Invalid Return In Case Data";
        $messages['rma.how_long.required'] = "How Long is Required";
        $messages['rma.how_long.string'] = "How Long Should Be String";
        $messages['rma.how_long.min'] = "How Long Should Not Be Less Than 3";
        $messages['rma.how_long.max'] = "How Long Should Not Be Greater Than 25";
        $messages['rma.customer_address_id.required'] = "Customer Details is Required";
        $messages['rma.customer_address_id.exists'] = "Invalid Customer Details";

        $messages['rma.delivery_info.contact_name.required'] = "Delivery Contant Name Is Required";
        $messages['rma.delivery_info.contact_name.string'] = "Delivery Contant Name Should Be String";
        $messages['rma.delivery_info.contact_name.min'] = "Delivery Contant Name Should Not Be Less Than 3";
        $messages['rma.delivery_info.contact_name.max'] = "Delivery Contant Name Should Not Be Greater Than 10";
        $messages['rma.delivery_info.delivery_address.required'] = "Delivery Address Is Required";
        $messages['rma.delivery_info.delivery_address.string'] = "Delivery Address Should Be String";
        $messages['rma.delivery_info.delivery_address.min'] = "Delivery Address Should Not Be Less Than 3";
        $messages['rma.delivery_info.delivery_address.max'] = "Delivery Address Should Not Be Greater Than 100";
        $messages['rma.delivery_info.delivery_email.required'] = "Delivery Email Is Required";
        $messages['rma.delivery_info.delivery_email.email'] = "Invalid Delivery Email";
        $messages['rma.delivery_info.tel_no.required'] = "Delivery Tel No Is Required";
        $messages['rma.delivery_info.tel_no.numeric'] = "Delivery Tel No Should Be Numeric";
        $messages['rma.delivery_info.tel_no.min'] = "Delivery Tel No Should Not Be Less Than 7";
        $messages['rma.delivery_info.tel_no.max'] = "Delivery Tel No Should Not Be Greater Than 15";
        $messages['rma.delivery_info.gst_number.required'] = "Delivery GST No Is Required";
        $messages['rma.delivery_info.gst_number.numeric'] = "Delivery GST No Should Be String";
        $messages['rma.delivery_info.gst_number.min'] = "Delivery GST No Should Be 15 Characters";
        $messages['rma.delivery_info.gst_number.max'] = "Delivery GST No Should Be 15 Characters";

        $messages['rma.unit_information.required'] = "Unit Information Is Required";
        $messages['rma.unit_information.array'] = "Unit Information Must Be An Array";

        $messages['rma.unit_information.*.model_id.required'] = "Model Id Is Required";
        $messages['rma.unit_information.*.model_id.exists'] = "Invalid Model Id";

        $messages['rma.unit_information.*.service_type.required'] = "Service Type Is Required";
        $messages['rma.unit_information.*.service_type.digits_between'] = "Invalid Service Type";

        $messages['rma.unit_information.*.sw_version.required'] = "SW Version Is Required";
        $messages['rma.unit_information.*.sw_version.string'] = "SW Version Should Be String";
        $messages['rma.unit_information.*.sw_version.min'] = "SW Version Should Not Be Lesser Than 1";
        $messages['rma.unit_information.*.sw_version.max'] = "SW Version Should Not Be Greater Than 5";

        $messages['rma.unit_information.*.warrenty.required'] = "Warrenty Is Required";
        $messages['rma.unit_information.*.warrenty.digits_between'] = "Invalid Warrenty";

        $messages['rma.unit_information.*.serial_no.required'] = "Serial Number Is Required";
        $messages['rma.unit_information.*.serial_no.array'] = "Serial Number Must Be An Array";

        $messages['rma.unit_information.*.serial_no.*.required'] = "Serial Number Is Required";
        $messages['rma.unit_information.*.serial_no.*.string'] = "Invalid Serial Number";
        $messages['rma.unit_information.*.serial_no.*.min'] = "Serial Number Should Be Greater Than 3";
        $messages['rma.unit_information.*.serial_no.*.max'] = "Serial Number Should Be Lesser Than 10";

        return $messages;*/
    }
}
