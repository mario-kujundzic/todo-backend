<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

class RegisterAuthRequest extends FormRequest
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
            'name' => 'required|max:255',
            'email' => 'required|max:255|email|unique:users,email',
            'password' => 'required|max:255|min:6'
        ];
    }

    public function messages() 
    {
        return [
            'name.required' => 'You must enter a name!',
            'name.max' => 'Name cannot be longer than 255 characters!',
            'email.unique' => 'An account with the entered email already exists!',
            'email.required' => 'You must enter your email!',
            'email.email' => 'You must enter a valid email address!',
            'email.max' => 'Email cannot be longer than 255 characters!',
            'password.required' => 'You must enter your password!',
            'password.min' => 'Password must be at least 6 characters!',
            'password.max' => 'Password cannot be longer than 255 characters!',
        ];
    }
}
