<?php
namespace App\Http\Controllers;

use App\Models\Todo;
use App\Models\Category;
use Illuminate\Http\Request;

class TodoController extends Controller
{
    public function index()
    {
        $todos = Todo::with('category')->get();
        return view('todos.index', compact('todos'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('todos.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'category_id' => 'required',
        ]);

        Todo::create($request->all());
        return redirect()->route('todos.index');
    }

    public function show(Todo $todo)
    {
        return view('todos.show', compact('todo'));
    }

    public function edit(Todo $todo)
    {
        $categories = Category::all();
        return view('todos.edit', compact('todo', 'categories'));
    }

    public function update(Request $request, Todo $todo)
    {
        $request->validate([
            'title' => 'required',
            'category_id' => 'required',
        ]);

        $todo->update($request->all());
        return redirect()->route('todos.index');
    }

    public function updatestatus(Request $request, $id)
    {
        $todo = Todo::findOrFail($id);

        if ($request->has('completed')) {
            $todo->completed = $request->input('completed');
            $todo->save();
        }

        return redirect()->route('todos.index')->with('success', 'Todo status updated successfully');
    }

    public function destroy(Todo $todo)
    {
        $todo->delete();
        return redirect()->route('todos.index');
    }
}