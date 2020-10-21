<?php

namespace App\Http\Requests\Todo;

use App\Models\Todo;
use Illuminate\Foundation\Http\FormRequest;

class DeleteTodoRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        $todo = Todo::find($this->route('todo'));
        return $todo && $this->user()->can('delete', $todo);
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
            'todo' => 'required|integer|exists:todos,id'
        ];
    }
    public function messages() 
    {
        return [
            'todo.required' => 'Id is required!',
            'todo.integer' => 'Id must be a number!',
            'todo.exists' => 'Todo with that id does not exist!'
        ];
    }
}
