@extends('layouts.app')

@section('title', 'Category Details')

@section('content')
    <h1>{{ $category->name }}</h1>
    <a href="{{ route('categories.index') }}" class="btn btn-secondary">Back to Categories</a>
@endsection