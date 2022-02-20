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
                            <a class="btn btn-primary" href="{{ route('roles.index') }}">Back</a>
                        </span>
                    @endcan
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('roles.update', $role->id) }}">
                        @csrf
                        @method("PATCH")
                        <div class="form-group mb-2">
                            <label for="name">Name</label>
                            <input class="form-control" type="text" name="name" value="{{ old('name') }}" required />
                        </div>
                        <div class="form-group mb-3">
                            <label for="permission">Permission</label>
                            @foreach ($permissions as $permission)
                                <div class="form-group mb-2 d-flex">
                                    <input {{ $role->permissions->contains($permission) ? 'checked' : '' }} class="mt-auto mb-auto form-check-input" style="margin-right: 0.5em" name="permission" type="checkbox" />
                                    <label for="permission">{{ $permission->name }}</label>
                                </div>
                            @endforeach
                        </div>
                        <button type="submit" class="btn btn-primary">Create</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection