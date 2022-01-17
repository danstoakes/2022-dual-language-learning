@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        @include("partials.popup")
        <div class="col-md-9">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <p class="m-0">Role</p>
                    @can('role-list')
                        <span>
                            <a class="btn btn-primary" href="{{ route('roles.index') }}">Back</a>
                        </span>
                    @endcan
                </div>
                <div class="card-body">
                    <div class="lead">
                        <strong>Name:</strong>
                        {{ $role->name }}
                    </div>
                    <div class="lead">
                        <strong>Permissions:</strong>
                        @if(!empty($rolePermissions))
                            @foreach($rolePermissions as $permission)
                                <label class="badge badge-success">{{ $permission->name }}</label>
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection