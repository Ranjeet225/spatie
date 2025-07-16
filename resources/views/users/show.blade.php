@extends('layouts.app')

@section('content')
<div class="container">
    <h1>User Details</h1>
    <div class="mb-3">
        <strong>Name:</strong> {{ $user->name }}
    </div>
    <div class="mb-3">
        <strong>Email:</strong> {{ $user->email }}
    </div>
    <div class="mb-3">
        <strong>Role:</strong> {{ $user->role ? $user->role->name : '-' }}
    </div>
    <a href="{{ route('users.edit', $user) }}" class="btn btn-warning">Edit</a>
    <a href="{{ route('users.index') }}" class="btn btn-secondary">Back</a>
</div>
@endsection 