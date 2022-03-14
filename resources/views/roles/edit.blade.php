@extends('layouts.app')
@section('title', 'Edit Role')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        @include("partials.popup")
        <div class="col-md-9">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <p class="m-0">Edit Role</p>
                    @can('role-list')
                        <span>
                            <a class="btn btn-primary" href="{{ route('roles.show', $role) }}">Back</a>
                        </span>
                    @endcan
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('roles.update', $role->id) }}">
                        @csrf
                        @method("PATCH")
                        <div class="form-group mb-2">
                            <label for="name">Name</label>
                            <input class="form-control" type="text" name="name" value="{{ old('name', $role->name) }}" required />
                        </div>
                        <div class="form-group mb-2">
                            <label for="description">Description</label>
                            <input type="text" value="{{ old('description') ?? $role->description }}" class="form-control" name="description" rows="4" maxlength="128" oninput="changeCount(event, 'description_characters')" onfocus="changeCount(event, 'description_characters')" required />
                            <small id="description_characters" class="form-text text-muted"></small>
                        </div>
                        <div class="form-group mb-3">
                            <p class="mb-1">Manage Permissions</p>
                            @foreach ($permissions as $key=>$permission)
                                <div class="form-check form-switch mb-0 {{ $key > 0 ? 'mt-2' : '' }}">
                                    <input {{ $role->permissions->contains($permission) ? 'checked' : '' }} class="form-check-input" type="checkbox" name="permission[]" value="{{ $permission->id }}">
                                    <label class="form-check-label" for="flexSwitchCheckChecked">{{ $permission->name }}</label>
                                </div>
                                <small class="form-text text-muted">{{ $permission->description }}</small>
                            @endforeach
                        </div>
                        <button type="submit" class="btn btn-primary">Update</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection