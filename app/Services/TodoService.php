<?php

namespace App\Services;

use App\Models\Todo;
use App\Models\User;
use Exception;
use Illuminate\Support\Facades\Auth;

class TodoService 
{
    public static function getMyTodos() 
    {
        $user = User::all()->find(Auth::user()->id);
        return $user->todos;
    }

    public static function addNewTodo($data)
    {
        $todo = Todo::create($data + ['user_id' => Auth::user()->id, 'completed' => false]);
        $todo->save();
        return $todo;
    }

    public static function getTodo($id)
    {
        return Todo::all()->find($id);
    }

    public static function updateTodo($data, $id)
    {
        $todo = Todo::all()->find($id);
        $todo->title = $data['title'];
        $todo->description = $data['description'];
        $todo->priority = $data['priority'];
        $todo->completed = $data['completed'];
        $todo->save();
        return $todo;
    }

    public static function completeTodo($data, $id)
    {
        $todo = Todo::all()->find($id);
        $todo->completed = $data['completed'];
        $todo->save();
        return $todo;
    }


    public static function deleteTodo($id) 
    {
        $todo = Todo::all()->find($id);
        $todo->delete();
    }
}