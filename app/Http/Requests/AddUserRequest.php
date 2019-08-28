<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddUserRequest extends FormRequest
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
            'user.code' => 'required|string|min:3|max:10',
            'user.name' => 'required|string|min:3|max:20',
            'user.email' => 'required|email',
            'user.password' => 'required|string|min:6|max:12',
            'user.role' => 'required|exists:roles,id'
        ];
    }

    public function messages()
    {
        return [
            'user.code.required' => 'User Code Is Required',
            'user.code.string' => 'User Code Should Be String',
            'user.code.min' => 'User Code Should Not Be Less Than 3',
            'user.code.max' => 'User Code Should Not Be Greater Than 10',
            'user.name.required'  => 'User Name Is Required',
            'user.name.string'  => 'User Name Should Be String',
            'user.name.min' => 'User Name Should Not Be Less Than 3',
            'user.name.max' => 'User Name Should Not Be Greater Than 20',
            'user.email.required' => 'Email Is Required',
            'user.email.email' => 'Invalid Email Format',
            'user.password.required' => 'Password Is Required',
            'user.password.string' => 'Password Should Be String',
            'user.password.min' => 'Password Should Not Be Less Than 6',
            'user.password.max' => 'Password Should Not Be Greater Than 12',
            'user.role.required' => 'Role Is Required',
            'user.role.exists' => 'Invalid Role',
        ];
    }
}
