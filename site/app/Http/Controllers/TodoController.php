<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TodoController extends Controller
{
    public function index()
    {
        $todos = Todo::where('user_id', Auth::id())->with('category')->get();
        return view('todos.index', compact('todos'));
    }

    public function create()
    {
        $categories = Category::where('user_id', Auth::id())->get();
        return view('todos.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'category_id' => 'required|exists:categories,id',
        ]);

        Todo::create([
            'title' => $request->title,
            'description' => $request->description,
            'category_id' => $request->category_id,
            'user_id' => Auth::id(),
            'is_completed' => false,
        ]);

        return redirect()->route('todos.index')->with('success', 'Todo created successfully.');
    }

    public function edit(Todo $todo)
    {
        $this->authorizeTodoOwner($todo);

        $categories = Category::where('user_id', Auth::id())->get();
        return view('todos.edit', compact('todo', 'categories'));
    }

    public function update(Request $request, Todo $todo)
    {
        $this->authorizeTodoOwner($todo);

        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'category_id' => 'required|exists:categories,id',
            'is_completed' => 'boolean',
        ]);

        $todo->update($request->only('title', 'description', 'category_id', 'is_completed'));

        return redirect()->route('todos.index')->with('success', 'Todo updated successfully.');
    }

    public function updatestatus(Request $request, $id)
    {
        $todo = Todo::findOrFail($id);
        $this->authorizeTodoOwner($todo);

        if ($request->has('is_completed')) {
            $todo->is_completed = $request->input('is_completed');
            $todo->save();
        }

        return redirect()->route('todos.index')->with('success', 'Todo status updated successfully');
    }

    public function destroy(Todo $todo)
    {
        $this->authorizeTodoOwner($todo);

        $todo->delete();
        return redirect()->route('todos.index')->with('success', 'Todo deleted successfully.');
    }

    private function authorizeTodoOwner(Todo $todo)
    {
        if ($todo->user_id != Auth::id()) {
            abort(403, 'Unauthorized action.');
        }
    }
}



