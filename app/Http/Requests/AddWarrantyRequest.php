<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddWarrantyRequestRequest extends FormRequest
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

            'warranty.rid' => 'required|numeric',

            'warranty.rid' => 'RID ',
            'warranty.smp' => 'required|numeric|digits_between:1,2',
            'warranty.pcp' => 'required|numeric|digits_between:1,2',
            'warranty.type' => 'required|numeric|digits_between:1,2',
            'warranty.move' => 'required|numeric|digits_between:1,5',
            'warranty.rca' => 'required|boolean',
            'warranty.comment' => 'required|string|min:3|max:20',
            'warranty.po' => 'required|string|min:3|max:20',
            'warranty.wbs' => 'required|string|min:3|max:20',
            'warranty.mail_to' => 'required|numeric',
            'warranty.cc' => 'required|numeric'
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
            'warranty.cc' => 'CC'
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
