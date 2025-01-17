<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CompleteJobTicketRequest extends FormRequest
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
            'jobticket.id' => 'nullable|exists:job_tickets,id',
            'jobticket.job_ticket_materials.*.part_no' => 'required',
            'jobticket.job_ticket_materials.*.old_pcp' => 'required',
            'jobticket.job_ticket_materials.*.new_pcp' => 'required_if:jobticket.service_type,1',
        ];
    }

    public function attributes()
    {
        return [
            'jobticket.job_ticket_materials.*.part_no' => 'Part No',
            'jobticket.job_ticket_materials.*.value' => 'Value',
            'jobticket.job_ticket_materials.*.old_pcp' => 'Defective PCB',
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
