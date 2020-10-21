<?php

namespace App\Http\Controllers;

use App\Http\Requests\Todo\DeleteTodoRequest;
use App\Http\Requests\Todo\ShowTodoRequest;
use App\Http\Requests\Todo\StoreTodoRequest;
use App\Http\Requests\Todo\UpdateTodoRequest;
use App\Models\Todo;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

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
        $user = User::all()->find(Auth::user()->id);
        return response()->json($user->todos);
    }
    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTodoRequest $request)
    {
        $validated = $request->validated();
        $todo = Todo::create($validated + ['user_id' => Auth::user()->id, 'completed' => false]);
        $todo->save();
        return response()->json('Successfully created todo!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(ShowTodoRequest $request, $id)
    {
        $todo = Todo::all()->find($id);
        return response()->json($todo);
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
        $validated = $request->validated();
        $todo = Todo::all()->find($todo);
        $todo->title = $validated['title'];
        $todo->description = $validated['description'];
        $todo->priority = $validated['priority'];
        $todo->completed = $validated['completed'];
        $todo->save();
        return response()->json('Successfully edited');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(DeleteTodoRequest $request, $id)
    {
        $todo = Todo::all()->find($id);
        $todo->delete();
        return response()->json('Successfully deleted!');
    }
}
