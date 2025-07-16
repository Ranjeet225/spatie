@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Edit Role</h1>
    <form action="{{ route('roles.update', $role) }}" method="POST">
        @csrf   
        @method('PUT')
        <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input type="text" name="name" class="form-control" value="{{ old('name', $role->name) }}" required>
            @error('name')<div class="text-danger">{{ $message }}</div>@enderror
        </div>
        <div class="mb-3">
            <label for="permissions" class="form-label">Permissions</label>
            @foreach($permissions as $permission)
                <div>
                    <input type="checkbox" name="permissions[]" value="{{ $permission->id }}" 
                        {{ $role->permissions->contains($permission->id) ? 'checked' : '' }}>
                    <label for="permission-{{ $permission->id }}">{{ $permission->name }}</label>
                </div>
            @endforeach
        </div>
            <button type="submit" class="btn btn-primary">Update</button>
        <a href="{{ route('roles.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection
