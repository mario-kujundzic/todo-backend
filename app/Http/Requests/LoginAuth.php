<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LoginAuth extends FormRequest
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
            'email' => 'required|max:255|email|exists:users,email',
            'password' => 'required|max:255|min:6'
        ];
    }

    public function messages() 
    {
        return [
            'email.exists' => 'No user with the entered email found!',
            'email.required' => 'You must enter your email!',
            'email.email' => 'You must enter a valid email address!',
            'email.max' => 'Email cannot be longer than 255 characters!',
            'password.required' => 'You must enter your password!',
            'password.min' => 'Password must be at least 6 characters!',
            'password.max' => 'Password cannot be longer than 255 characters!',
        ];
    }
}
