<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddCustomerRequest extends FormRequest
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
            'customer.id' => 'nullable|exists:ma_customer,id',
            'customer.code' => 'required|string|min:1|max:25',
            'customer.name' => 'required|string|min:2|max:100',
            'customer.address' => 'required|string|min:3|max:200',
            'customer.pincode' => 'required',
            'customer.contact_person' => 'required|string|min:3|max:20',
            'customer.gst' => 'required|string|min:15|max:15',
            'customer.email' => 'required|email',
            'customer.contact' => 'required|numeric|digits_between:6,16',
            'customer.site_id' => 'nullable|numeric|exists:ma_site,id',
            'customer.location_id' => 'required|numeric|exists:ma_location,id',
        ];
    }

    public function messages()
    {
        return [
            'customer.code.required' => 'Customer Code Is Required',
            'customer.code.string' => 'Customer Code Should Be String',
            'customer.code.min' => 'Customer Code Should Not Be Less Than 3',
            'customer.code.max' => 'Customer Code Should Not Be Greater Than 10',
            'customer.code.unique' => 'Customer Code Already Exists',
            'customer.name.required'  => 'Customer Name Is Required',
            'customer.name.string'  => 'Customer Name Should Be String',
            'customer.name.min' => 'Customer Name Should Not Be Less Than 3',
            'customer.name.max' => 'Customer Name Should Not Be Greater Than 20',
            'customer.address.required' => 'Address Is Required',
            'customer.address.string' => 'Address Should Be String',
            'customer.address.min' => 'Address Should Not Be Less Than 3',
            'customer.address.max' => 'Address Should Not Be Greater Than 100',
            'customer.pincode.required' => 'Pincode Required',
            'customer.contact_person.required' => 'Contact Person Is Required',
            'customer.contact_person.string' => 'Contact Person Should Be String',
            'customer.contact_person.min' => 'Contact Person Should Not Be Less Than 3',
            'customer.contact_person.max' => 'Contact Person Should Not Be Greater Than 20',
            'customer.gst.required' => 'GST Is Required',
            'customer.gst.string' => 'GST Should Be String',
            'customer.gst.min' => 'GST Is Should Be 15 Characters',
            'customer.gst.max' => 'GST Is Should Be 15 Characters',
            'customer.email.required' => 'Email Is Required',
            'customer.email.email' => 'Envalid Email Format',
            'customer.contact.required' => 'Contact Is Required',
            'customer.contact.numeric' => 'Contact Should Be Numeric',
            'customer.contact.digits_between' => 'Contact Should Be Between 10 To 15 Digits',
            'customer.site_id.required' => 'Site ID Is Required',
            'customer.site_id.numeric' => 'Site ID Should Be Numeric',
            'customer.site_id.exists' => 'Invalid Site ID',
            'customer.location_id.required' => 'Location ID Is Required',
            'customer.location_id.numeric' => 'Location ID Should Be Numeric',
            'customer.location_id.exists' => 'Invalid Location ID',
        ];
    }
}
