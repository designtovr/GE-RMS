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

            'physicalverification.id' => 'nullable|exists:physical_verification,id',
            'physicalverification.receipt_id' => 'required|numeric|exists:receipt,id',
            'physicalverification.courier_name' => 'required|string|min:3|max:9',
            'physicalverification.docket_details' => 'required|string|min:3|max:9',
            'physicalverification.pvdate' => 'required|string',
            'physicalverification.producttype_id' => 'required|exists:ma_product_type,id',
            'physicalverification.product' => 'required_without:manual_part_no|array',
            'physicalverification.case' => 'required|numeric|digits_between:1,15',
            'physicalverification.serial_no' => 'required|string',
            'physicalverification.part_no' => 'required_with:manual_part_no|string',
            'physicalverification.battery' => 'required|numeric|digits_between:0,3',
            'physicalverification.case_condition' => 'required|numeric|digits_between:0,3',
            'physicalverification.battery_condition' => 'required|numeric|digits_between:0,3',
            'physicalverification.terminal_blocks' => 'required|numeric|digits_between:0,3',
            'physicalverification.terminal_blocks_condition' => 'required|numeric|digits_between:0,3',
            'physicalverification.no_of_terminal_blocks' => 'required_if:terminal_blocks,1|numeric',
            'physicalverification.top_bottom_cover' => 'required|numeric|digits_between:0,3',
            'physicalverification.sales_order_no' => 'nullable|string|min:3|max:15',
            'physicalverification.short_links_condition' => 'required|numeric|digits_between:0,3',
            'physicalverification.short_links' => 'required|numeric|digits_between:0,3',
            'physicalverification.no_of_short_links' => 'required_if:short_links,1|numeric',
            'physicalverification.top_bottom_cover_condition' => 'required|numeric|digits_between:0,3',
            'physicalverification.is_rma_available' => 'required|boolean'
        ];
    }

    public function attributes()
    {
        return [
            'physicalverification.receipt_id' => 'Receipt number',
            'physicalverification.rid' => 'RID ',
            'physicalverification.courier_name' => 'Courier Name',
            'physicalverification.docket_details' => 'Docket Details Name',
            'physicalverification.pvdate' => 'Physical Verification Date ',
            'physicalverification.product' => 'Product',
            'physicalverification.producttype_id' => 'Product Type',
            'physicalverification.product' => 'Product',
            'physicalverification.defect' => 'Defect',
            'physicalverification.case' => 'Case',
            'physicalverification.serial_no' => 'Serial Number',
            'physicalverification.model_no' => 'Model Number',
            'physicalverification.battery' => 'Battery',
            'physicalverification.case_condition' => 'Case Condition',
            'physicalverification.battery_condition' => 'Battery Condition',
            'physicalverification.terminal_blocks' => 'Terminal Blocks',
            'physicalverification.terminal_blocks_condition' => 'Terminal Blocks Condition',
            'physicalverification.no_of_terminal_blocks' => 'No Of Terminal Blocks',
            'physicalverification.top_bottom_cover' => 'Top Bottom Cover',
            'physicalverification.sales_order_no' => 'Sales Order Number',
            'physicalverification.short_links' => 'Short Links',
            'physicalverification.short_links_condition' => 'Short Links Condition',
            'physicalverification.no_of_short_links' => 'No Of Short Links',
            'physicalverification.top_bottom_cover_condition' => 'Top Bottom Cover Condition',
            'physicalverification.is_rma_available' => 'Is Ram Availabe'
        ];
    }

    public function messages()
    {
        return [
            'required' => ' :attribute is Required',
            'min' => ' :attribute Should Not Be Less Than :min',
            'max' => ' :attribute Should Not Be Greater Than :max',
            'string' => ' :attribute Should Be String',
            'json' => 'Invalid :attribute',
            'array' => 'Invalid :attribute',
            'boolean' => 'Invalid :attribute',
            'numeric' => ' :attribute Should Be Number',
            'digits_between' => ' :attribute value is invalid',
            'exists' => 'Invalid :attribute',
        ];
    }
}
