<?php

namespace App\Http\Controllers;

use App\Http\Requests\Todo\DeleteTodoRequest;
use App\Http\Requests\Todo\ShowTodoRequest;
use App\Http\Requests\Todo\StoreTodoRequest;
use App\Http\Requests\Todo\UpdateTodoRequest;
use App\Services\TodoService;
use Exception;

class TodoController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $todos = TodoService::getMyTodos();
        return response()->json($todos);
    }
    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTodoRequest $request)
    {
        try {
            $validated = $request->validated();
            TodoService::addNewTodo($validated);
            return response()->json('Successfully created todo!');
        } catch (Exception $e) {
            return response()->json('Something went wrong with the request.', 400);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(ShowTodoRequest $request, $todo)
    {
        return response()->json(TodoService::getTodo($todo));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateTodoRequest $request, $todo)
    {
        try {
            $validated = $request->validated();
            $updated = TodoService::updateTodo($validated, $todo);
            return response()->json($updated);
        } catch (Exception $e) {
            return response()->json('Something went wrong with the request.', 400);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(DeleteTodoRequest $request, $todo)
    {
        try {
            TodoService::deleteTodo($todo);
            return response()->json('Successfully deleted.');
        } catch (Exception $e) {
            return response()->json('Something went wrong with the request.', 400);
        }
    }
}
