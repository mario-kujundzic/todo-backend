<?php

namespace App\Http\Requests;

use App\Models\Todo;
use Illuminate\Foundation\Http\FormRequest;

class UpdateTodo extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        $todo = Todo::find($this->route('todo'));
        return $todo && $this->user()->can('update', $todo);
    }

    public function validationData() {
        return $this->all() + $this->route()->parameters();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'todo' => 'required|exists:todos,id',
            'title' => 'required|max:255',
            'description' => 'required|max:255',
            'priority' => 'required|integer',
            'completed' => 'required|boolean'
        ];
    }
    public function messages() 
    {
        return [
            'todo.integer' => 'Id must be a number!',
            'todo.required' => 'Id is required!',
            'todo.exists' => 'Entered todo does not exist',
            'title.required' => 'Title is required!',
            'title.max' => 'Title cannot be longer than 255 letters!',
            'description.required' => 'Description is required!',
            'description.max' => 'Description cannot be longer than 255 letters!',
            'priority.max' => 'Priority is required!',
            'priority.max' => 'Priority must be number from 0-2!',
            'completed.required' => 'Completion must be selected!',
            'completed.boolean' => 'Completion must be a boolean!'
        ];
    }

}
