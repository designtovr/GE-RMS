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
            /*'user.code' => 'required|string|min:3|max:10',*/
            'user.id' => 'nullable|exists:users,id',
            'user.name' => 'required|string|min:3|max:50',
            'user.username' => 'required|string|min:3|max:50',
            'user.email' => 'nullable|email',
            'user.password' => 'required|string',
            'user.role' => 'required|exists:roles,id'
        ];
    }

    public function messages()
    {
        return [
            'user.name.required'  => 'Name Is Required',
            'user.name.string'  => 'Name Should Be String',
            'user.name.min' => 'Name Should Not Be Less Than 3',
            'user.name.max' => 'Name Should Not Be Greater Than 50',
            'user.username.required'  => 'Username Is Required',
            'user.username.string'  => 'Username Should Be String',
            'user.username.min' => 'Username Should Not Be Less Than 3',
            'user.username.max' => 'Username Should Not Be Greater Than 50',
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
