@extends('layouts.app')

@section('title', 'Todo Details')

@section('content')
    <h1>{{ $todo->title }}</h1>
    <p>{{ $todo->description }}</p>
    <p>Category: {{ $todo->category->name }}</p>
    <p>Completed: {{ $todo->completed ? 'Yes' : 'No' }}</p>

    <form action="{{ route('todos.complete', $todo->id) }}" method="POST" style="display:inline;">
        @csrf
        @method('PATCH')
        <input type="hidden" name="completed" value="{{ $todo->completed ? 0 : 1 }}">
        <button type="submit" class="btn btn-{{ $todo->completed ? 'warning' : 'success' }}">
            {{ $todo->completed ? 'Mark as Incomplete' : 'Mark as Done' }}
        </button>
    </form>

    <a href="{{ route('todos.index') }}" class="btn btn-secondary">Back to Todos</a>
@endsection