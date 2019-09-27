<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddPhysicalVerificationRequest extends FormRequest
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


            'physicalverification.receipt_no' => 'required|numeric',

             'physicalverification.courier_name' => 'required|string|min:3|max:9',
            'physicalverification.docket_details' => 'required|string|min:3|max:9',
            'physicalverification.pvdate' => 'required|string',
            'physicalverification.product' => 'required|string|min:3|max:100',
            'physicalverification.product_type' => 'required|string|min:3|max:20',
            'physicalverification.defect' => 'required|string',
            'physicalverification.case' => 'required|numeric|digits_between:1,15',
            'physicalverification.serial_no' => 'required|string',
            'physicalverification.model_no' => 'required|string',
            'physicalverification.battery' => 'required|numeric|digits_between:0,3',
            'physicalverification.case_condition' => 'required|numeric|digits_between:0,3',
            'physicalverification.battery_condition' => 'required|numeric|digits_between:0,15',
            'physicalverification.terminal_blocks' => 'required|numeric|digits_between:0,15',
            'physicalverification.terminal_blocks_condition' => 'required|numeric|digits_between:0,15',
            'physicalverification.top_bottom_cover' => 'required|numeric|digits_between:0,15',
            'physicalverification.sales_order_no' => 'required|numeric|digits_between:0,15',
            'physicalverification.short_links_condition' => 'required|numeric|digits_between:0,15',
            'physicalverification.short_links' => 'required|numeric|digits_between:0,15',
            'physicalverification.top_bottom_cover_condition' => 'required|numeric|digits_between:0,15',
        ];
    }

    public function attributes()
    {
        return [
            'physicalverification.receipt_no' => 'Receipt number',
            'physicalverification.rid' => 'RID ',
            'physicalverification.courier_name' => 'Courier Name',
            'physicalverification.docket_details' => 'Docket Details Name',
            'physicalverification.pvdate' => 'Physical Verification Date ',
            'physicalverification.product' => 'Product',
            'physicalverification.product_type' => 'Product Type',
            'physicalverification.defect' => 'Defect',
            'physicalverification.case' => 'Case',
            'physicalverification.serial_no' => 'Serial Number',
            'physicalverification.model_no' => 'Model Number',
            'physicalverification.battery' => 'Battery',
            'physicalverification.case_condition' => 'Case Condition',
            'physicalverification.battery_condition' => 'Battery Condition',
            'physicalverification.terminal_blocks' => 'Terminal Blocks',
            'physicalverification.terminal_blocks_condition' => 'Terminal Blocks Condition',
            'physicalverification.top_bottom_cover' => 'Top Bottom Cover',
            'physicalverification.sales_order_no' => 'Sales Order Number',
            'physicalverification.short_links_condition' => 'Short Links Condition',
            'physicalverification.top_bottom_cover_condition' => 'Top Bottom Cover Condition',
            'physicalverification.short_links' => 'Short Links',
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
        ];
    }
}
