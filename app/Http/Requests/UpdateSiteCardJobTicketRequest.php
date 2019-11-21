<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateSiteCardJobTicketRequest extends FormRequest
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
            'jobticket.job_ticket_materials.*.new_pcp' => 'required',
        ];
    }

    public function attributes()
    {
        return [
            'jobticket.job_ticket_materials.*.new_pcp' => 'New PCB',
        ];
    }

    public function messages()
    {
        return [
            'required' => ':attribute Required',
            'exists' => 'Invalid :attribute'
        ];
    }
}
