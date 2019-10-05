<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SaveJobTicketMaterialRequest extends FormRequest
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
            'jobticketmaterial.job_ticket_materials.*.part_no' => 'required|string|min:3|max:50',
            'jobticketmaterial.job_ticket_materials.*.value' => 'required|string|min:1|max:10',
            'jobticketmaterial.job_ticket_materials.*.old_pcp' => 'required|string|min:3|max:50',
            'jobticketmaterial.job_ticket_materials.*.new_pcp' => 'required|string|min:3|max:50',
            'jobticketmaterial.job_ticket_materials.*.comment' => 'required|string|min:3|max:100',
        ];
    }

    public function attributes()
    {
        return [

        ];
    }

    public function messages()
    {
        return [

        ];
    }
}
