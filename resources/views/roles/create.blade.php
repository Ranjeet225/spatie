@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Create Role</h1>
    <form action="{{ route('roles.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input type="text" name="name" class="form-control" value="{{ old('name') }}" required>
            @error('name')<div class="text-danger">{{ $message }}</div>@enderror
        </div>
        <div class="mb-3 d-flex flex-wrap">
            @foreach($permissions->chunk(4) as $permissionChunk)
                @foreach($permissionChunk as $permission)
                    <div class="form-check form-check-inline mr-3">
                        <input class="form-check-input" type="checkbox" name="permissions[]" value="{{ $permission->id }}" 
                            {{ old('permissions') && in_array($permission->id, old('permissions', [])) ? 'checked' : '' }}>
                        <label class="form-check-label" for="permission-{{ $permission->id }}">{{ $permission->name }}</label>
                    </div>
                @endforeach
            @endforeach
        </div>
        <button type="submit" class="btn btn-primary">Create</button>
        <a href="{{ route('roles.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection
