@extends('layouts.admin')
@section('title', 'Edit Role User')

@section('content')
    <form action="{{ route('admin.users.update', $user->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label>Nama User</label>
            <input type="text" class="form-control" value="{{ $user->name }}" disabled>
        </div>
        <div class="mb-3">
            <label>Email</label>
            <input type="email" class="form-control" value="{{ $user->email }}" disabled>
        </div>
        <div class="mb-3">
            <label>Role</label>
            <select name="role" class="form-control" required>
                <option value="user" {{ $user->role == 'user' ? 'selected' : '' }}>User</option>
                <option value="admin" {{ $user->role == 'admin' ? 'selected' : '' }}>Admin</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Update Role</button>
    </form>
@endsection