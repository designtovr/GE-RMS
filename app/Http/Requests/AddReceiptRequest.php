<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddReceiptRequest extends FormRequest
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

            'receipt.id' => 'nullable|numeric|exists:receipt,id',
            /*'receipt.gs_no' => 'required|numeric',*/
            'receipt.receipt_date' => 'required|string',
            'receipt.customer_id' => 'required|exists:ma_customer,id',
            /*'receipt.customer_name' => 'required|string|min:3|max:50',*/
            /*'receipt.end_customer' => 'required|string|min:3|max:50',*/
            'receipt.site' => 'required',
            'receipt.total_boxes' => 'required|numeric|digits_between:1,15',
        ];
    }

    public function attributes()
    {
        return [
            'receipt.id' => 'Receipt Id',
            'receipt.gs_no' => 'GS Number',
            'receipt.receipt_date' => 'Receipt Date',
            'receipt.customer_name' => 'Customer Name ',
            'receipt.end_customer' => 'End Customer',
            'receipt.courier_name' => 'Courier Name',
            'receipt.docket_details' => 'Docket Details',
            'receipt.total_boxes' => 'Number of Boxes',
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
            'digits_between' => ' :attribute value is invalid',
            'exists' => 'Invalid :attribute'
        ];
    }
}
