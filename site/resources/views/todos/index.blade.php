@extends('layouts.app')

@section('title', 'Todos')

@section('content')
    <h1>Todos</h1>
    <a href="{{ route('todos.create') }}" class="btn btn-primary mb-3">Create Todo</a>
    <a href="{{ route('categories.create') }}" class="btn btn-default mb-3">Add Category</a>
    <ul class="list-group">
        @foreach ($todos as $todo)
            <li class="list-group-item d-flex justify-content-between align-items-center">
                <a href="{{ route('todos.show', $todo->id) }}" style="{{ $todo->is_completed ? 'text-decoration: line-through;' : '' }}">{{ $todo->title }}</a>
                <div>
                    <form action="{{ route('todos.complete', $todo->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('PATCH')
                        <input type="hidden" name="is_completed" value="{{ $todo->is_completed ? 0 : 1 }}">
                        <button type="submit" class="btn btn-{{ $todo->is_completed ? 'warning' : 'success' }}">
                            {{ $todo->is_completed ? 'Mark as Incomplete' : 'Mark as Done' }}
                        </button>
                    </form>
                    <a href="{{ route('todos.edit', $todo->id) }}" class="btn btn-secondary btn-sm">Edit</a>
                    <form action="{{ route('todos.destroy', $todo->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                    </form>
                </div>
            </li>
        @endforeach
    </ul>
@endsection