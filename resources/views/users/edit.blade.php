@extends('layouts.app')
@section('title', 'Edit User')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        @include("partials.popup")
        <div class="col-md-9">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <p class="m-0">Edit User</p>
                    @can('user-list')
                        <span>
                            <a class="btn btn-primary" href="{{ route('users.index') }}">Back</a>
                        </span>
                    @endcan
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('users.update', $user->id) }}">
                        @csrf
                        @method("PATCH")
                        <div class="form-group mb-2">
                            <label for="name">Name</label>
                            <input class="form-control" type="text" name="name" value="{{ old('name') ?? $user->name }}" required />
                        </div>
                        <div class="form-group mb-2">
                            <label for="email">Email</label>
                            <input class="form-control" type="text" name="email" value="{{ old('email') ?? $user->email }}" required />
                        </div>
                        <div class="form-group mb-2">
                            <label for="password">Password</label>
                            <input class="form-control" type="password" name="password" placeholder="Optional" />
                        </div>
                        <div class="form-group mb-2">
                            <label for="password_confirmation">Confirm Password</label>
                            <input class="form-control" type="password" name="password_confirmation" placeholder="Optional" />
                        </div>
                        <div class="form-group mb-3">
                            <label for="role">Role</label>
                            <select name="role" class="form-control form-select form-select-md" required>
                                <option>Select a role</option>
                                @if (isset($roles))
                                    @foreach ($roles as $key => $role)
                                        <option {{ $user->roles->contains($role) ? 'selected' : '' }} value="{{ $role->id }}">{{ $role->name }}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary">Update</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection