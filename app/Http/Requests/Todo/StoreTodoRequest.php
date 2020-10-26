<?php

namespace App\Http\Requests\Todo;

use Illuminate\Foundation\Http\FormRequest;

class StoreTodoRequest extends FormRequest
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
            'title' => 'required|max:255',
            'description' => 'max:255',
            'priority' => 'required|integer',
            'completed' => 'required|boolean'
        ];
    }
    public function messages() 
    {
        return [
            'title.required' => 'Title is required!',
            'title.max' => 'Title cannot be longer than 255 letters!',
            'description.max' => 'Description cannot be longer than 255 letters!',
            'priority.max' => 'Priority is required!',
            'priority.integer' => 'Priority must be number from 0-2!',
            'completed.required' => 'Completion must be selected!',
            'completed.boolean' => 'Completion must be a boolean!'
        ];
    }
}
