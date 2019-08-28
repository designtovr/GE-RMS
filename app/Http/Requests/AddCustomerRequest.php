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
            'customer.code' => 'required|string|min:3|max:10',
            'customer.name' => 'required|string|min:3|max:20',
            'customer.address' => 'required|string|min:3|max:100',
            'customer.contact_person' => 'required|string|min:3|max:20',
            'customer.tin' => 'required|string|min:9|max:9',
            'customer.email' => 'required|email',
            'customer.contact' => 'required|numeric|digits_between:10,15',
            'customer.site_id' => 'required|numeric|exists:ma_site,id',
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
            'customer.name.required'  => 'Customer Name Is Required',
            'customer.name.string'  => 'Customer Name Should Be String',
            'customer.name.min' => 'Customer Name Should Not Be Less Than 3',
            'customer.name.max' => 'Customer Name Should Not Be Greater Than 20',
            'customer.address.required' => 'Address Is Required',
            'customer.address.string' => 'Address Should Be String',
            'customer.address.min' => 'Address Should Not Be Less Than 3',
            'customer.address.max' => 'Address Should Not Be Greater Than 100',
            'customer.contact_person.required' => 'Contact Person Is Required',
            'customer.contact_person.string' => 'Contact Person Should Be String',
            'customer.contact_person.min' => 'Contact Person Should Not Be Less Than 3',
            'customer.contact_person.max' => 'Contact Person Should Not Be Greater Than 20',
            'customer.tin.required' => 'TIN Is Required',
            'customer.tin.string' => 'TIN Should Be String',
            'customer.tin.min' => 'TIN Is Should Not Be Less Than 3',
            'customer.tin.max' => 'TIN Is Should Not Be Greater Than 20',
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
