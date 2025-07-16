@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Role Details</h1>
    <div class="mb-3">
        <strong>Name:</strong> {{ $role->name }}
    </div>
    <div class="mb-3">
        <strong>Users:</strong> {{ $role->users->count() }}
    </div>
    <div class="mb-3">
        <strong>User List:</strong>
        <ul>
            @foreach($role->users as $user)
                <li>{{ $user->name }} ({{ $user->email }})</li>
            @endforeach
        </ul>
    </div>
    <div class="mb-3">
        <strong>Permissions:</strong>
        <ul>
            @foreach($role->permissions as $permission)
                <li>{{ $permission->name }}</li>
            @endforeach
        </ul>
    </div>
    <a href="{{ route('roles.edit', $role) }}" class="btn btn-warning">Edit</a>
    <a href="{{ route('roles.index') }}" class="btn btn-secondary">Back</a>
</div>
@endsection 