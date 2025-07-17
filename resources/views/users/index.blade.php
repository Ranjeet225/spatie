@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Users</h1>
    @can('create-users')
    <a href="{{ route('users.create') }}" class="btn btn-primary mb-3">Create User</a>
    @endcan
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Role</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $user)
                <tr>
                    <td>{{ $user->id }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>
                        @if($user->roles->count())
                            @foreach($user->roles as $role)
                                <span class="badge bg-secondary">{{ $role->name }}</span>
                            @endforeach
                        @else
                            -
                        @endif
                    </td>
                    <td>
                        @can('view-users')
                        <a href="{{ route('users.show', $user) }}" class="btn btn-info btn-sm">Show</a>
                        @endcan
                        @can('edit-users')
                        <a href="{{ route('users.edit', $user) }}" class="btn btn-warning btn-sm">Edit</a>
                        @endcan
                        @can('delete-users')
                            @if($user->roles->contains('name', 'admin'))
                                <button class="btn btn-danger btn-sm" disabled>Delete</button>
                            @else
                                <form action="{{ route('users.destroy', $user) }}" method="POST" style="display:inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</button>
                                </form>
                            @endif
                        @endcan
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
