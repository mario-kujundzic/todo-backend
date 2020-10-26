<?php

namespace App\Http\Requests\Todo;

use App\Models\Todo;
use Illuminate\Foundation\Http\FormRequest;

class CompleteTodoRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        $todo = Todo::find($this->route('todo'));
        return $todo && $this->user()->can('complete', $todo);
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
            'completed' => 'required|boolean'
        ];
    }
    public function messages() 
    {
        return [
            'todo.integer' => 'Id must be a number!',
            'todo.required' => 'Id is required!',
            'todo.exists' => 'Entered todo does not exist',
            'completed.required' => 'Completion must be selected!',
            'completed.boolean' => 'Completion must be a boolean!'
        ];
    }

}
