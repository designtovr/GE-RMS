<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddWarrantyRequest extends FormRequest
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


            'warranty.smp' => 'required|numeric|digits_between:1,2',
            'warranty.pcp' => 'required|numeric|digits_between:1,2',
            'warranty.type' => 'required|numeric|digits_between:1,2',
            'warranty.move' => 'required|numeric|digits_between:1,5',
            'warranty.rca' => 'required|boolean',
            /*'warranty.comment' => 'string|min:3|max:20',*/
            'warranty.po' => 'string|min:3|max:20',
            'warranty.wbs' => 'string|min:3|max:20',

            'pvs.*' => 'required|numeric|exists:physical_verification,id'
        ];
    }

    public function attributes()
    {
        return [
            'warranty.rid' => 'RID ',
            'warranty.smp' => 'SMP',
            'warranty.pcp' => 'PCP',
            'warranty.type' => 'Type',
            'warranty.move' => 'Move To',
            'warranty.rca' => 'RCA',
            'warranty.comment' => 'Comment',
            'warranty.po' => 'PO',
            'warranty.wbs' => 'WBS',
            'warranty.mail_to' => 'Mail To',
            'warranty.cc' => 'CC',
            'pvs.*.id' => 'PV'
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
