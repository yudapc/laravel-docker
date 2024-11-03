@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Edit User Role</h2>

    <form action="{{ route('users.update', $user->id) }}" method="POST">
        @csrf
        @method('PUT')
        
        <div class="form-group">
            <label for="role">Role</label>
            <select name="role" class="form-control" required>
                <option value="super-admin" {{ $user->role == 'super-admin' ? 'selected' : '' }}>Super Admin</option>
                <option value="finance" {{ $user->role == 'finance' ? 'selected' : '' }}>Finance</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Update Role</button>
    </form>
</div>
@endsection
