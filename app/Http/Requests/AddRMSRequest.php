<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddRMSRequest extends FormRequest
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
            'rms.pv_id' => 'nullable',
            'rms.rack_id' => 'required',
        ];
    }

    public function messages()
    {
        return [
/*            'site.id.numeric' => 'Id Should Be Numeric',
            'site.id.exists' => 'Invalid Id',
            'site.code.required' => 'Site Code Is Required',
            'site.code.string' => 'Site Code Should Be String',
            'site.code.min' => 'Site Code Should Not Be Less Than 3',
            'site.code.max' => 'Site Code Should Not Be Greater Than 10',
            'site.name.required'  => 'Site Name Is Required',
            'site.name.string'  => 'Site Name Should Be String',
            'site.name.min' => 'Site Name Should Not Be Less Than 3',
            'site.name.max' => 'Site Name Should Not Be Greater Than 20',*/
        ];
    }
}
