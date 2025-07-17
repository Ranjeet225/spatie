@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Roles</h1>
    @can('create-roles')
    <a href="{{ route('roles.create') }}" class="btn btn-primary mb-3">Create Role</a>
    @endcan
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Users</th>
                <th>Permissions</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($roles as $role)
                <tr>
                    <td>{{ $role->id }}</td>
                    <td>{{ $role->name }}</td>
                    <td>{{ $role->users_count }}</td>
                    <td>
                        @foreach($role->permissions as $permission)
                            <span class="badge bg-primary">{{ $permission->name }}</span>
                        @endforeach
                    </td>
                        <td>
                      @can('view-roles')
                      <a href="{{ route('roles.show', $role) }}" class="btn btn-info btn-sm">Show</a>
                      @endcan
                      @can('edit-roles')
                        <a href="{{ route('roles.edit', $role) }}" class="btn btn-warning btn-sm">Edit</a>
                      @endcan
                      @can('delete-roles')
                        @if($role->id !== 1)
                            <form action="{{ route('roles.destroy', $role) }}" method="POST" style="display:inline-block;">
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
