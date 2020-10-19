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
            'email' => 'required|max:255|email',
            'password' => 'required|max:255'
        ];
    }

    public function messages() 
    {
        return [
            'email.required' => 'You must enter your email!',
            'email.email' => 'You must enter a valid email address!',
            'password.required' => 'You must enter your password!'
        ];
    }
}
