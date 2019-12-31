<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddSCRMARequest extends FormRequest
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
            'rma.date' => 'required|date_format:d/m/Y',
            'rma.unit_information.*.model' => 'required|array',
            'rma.unit_information.*.serial_no' => 'required',
            'rma.unit_information.*.field_volts_used' => 'required',
            /*'rma.unit_information.*.warrenty' => 'required',*/
            'rma.unit_information.*.equip_failed_on_service' => 'required',
            'rma.unit_information.*.equip_failed_on_installation' => 'required',
            'rma.end_customer' => 'required',
            'rma.delivery_info.name' => 'required',
            'rma.delivery_info.contact_person' => 'required',
            'rma.delivery_info.address' => 'required',
            'rma.delivery_info.tel_no' => 'required',
            'rma.delivery_info.email' => 'required',
            'rma.delivery_info.gst' => 'required',
            'rma.invoice_info.name' => 'required',
            'rma.invoice_info.contact_person' => 'required',
            'rma.invoice_info.address' => 'required',
            'rma.invoice_info.tel_no' => 'required',
            'rma.invoice_info.email' => 'required',
            'rma.invoice_info.gst' => 'required',
        ];
    }

    public function attributes()
    {
        return [
            'rma.data' => 'Date',
            'rma.unit_information.*.model' => 'Model',
            'rma.unit_information.*.serial_no' => 'Serial Number',
            'rma.unit_information.*.field_volts_used' => 'Field Volts Used',
            'rma.unit_information.*.warrenty' => 'Warranty',
            'rma.unit_information.*.equip_failed_on_service' => 'Equip Failed On Service',
            'rma.unit_information.*.equip_failed_on_installation' => 'Equip Failed On Installation',
            'rma.customer_address_id' => 'Customer',
            'rma.delivery_info.name' => 'Deliver Customer Name',
            'rma.delivery_info.contact_person' => 'Delivery Person',
            'rma.delivery_info.address' => 'Delivery Address',
            'rma.delivery_info.tel_no' => 'Delivery Tel No',
            'rma.delivery_info.email' => 'Delivery Email',
            'rma.delivery_info.gst' => 'Delivery GST',
            'rma.invoice_info.name' => 'Invoice Customer Name',
            'rma.invoice_info.contact_person' => 'Invoice Person',
            'rma.invoice_info.address' => 'Invoice Address',
            'rma.invoice_info.tel_no' => 'Invoice Tel No',
            'rma.invoice_info.email' => 'Invoice Email',
            'rma.invoice_info.gst' => 'Invoice GST',
            'rma.end_customer' => 'End Customer',
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
