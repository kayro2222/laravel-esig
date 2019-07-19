<?php

namespace App\Http\Controllers;

use App\Todo;
use Illuminate\Http\Request;

class TodosController extends Controller
{
    public function index()
    {
        return Todo::all();
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string',
            'completed' => 'required|boolean'
        ]);

        $todo = Todo::create($data);

        return response($todo, 201);
    }

    public function update(Request $request, Todo $todo)
    {
        $data = $request->validate([
            'title' => 'required|string',
            'completed' => 'required|boolean'
        ]);

        $todo->update($data);

        return response($todo, 200);
    }

    public function updateAll(Request $request)
    {
        $data = $request->validate([
            'completed' => 'required|boolean'
        ]);

        Todo::query()->update($data);

        return response('Updated', 200);
    }

    public function destroy(Todo $todo)
    {
        $todo->delete();

        return response('Deleted', 200);
    }

    public function destroyCompleted(Request $request)
    {
        $request->validate([
            'todos' => 'required|array'
        ]);
        
        Todo::destroy($request->todos);

        return response('Deleted', 200);
    }
}
