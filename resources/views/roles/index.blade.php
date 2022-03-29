@extends('layouts.app')
@section('title', 'Role Manager')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        @include("partials.popup")
        <div class="col-md-9">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <p class="m-0">Roles</p>
                    @can('role-create')
                        <span>
                            <a class="btn btn-primary" href="{{ route('roles.create') }}">
                                <p class="text-icon-inline card-text">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 d-inline d-sm-none" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" clip-rule="evenodd" />
                                    </svg>
                                    <span class="d-none d-sm-inline">
                                        New Role
                                    </span>
                                </p>
                            </a>
                        </span>
                    @else
                        @can('role-list')
                            <span>
                                <a class="btn btn-primary" href="{{ route('portal') }}">Back</a>
                            </span>
                        @endcan
                    @endcan
                </div>
                <div class="card-body">
                    @foreach ($data as $key => $role)
                        <div class="{{ $key != count($data) - 1 ? 'mb-3' : '' }}">
                            <a href="{{ route('roles.show', $role->id) }}" class="text-decoration-none text-black">
                                <div class="card flex flex-row align-items-center language-list-card">
                                    <div class="card-body language-details">
                                        <h4 class="card-title language-title language-title-large">{{ $role->name }}</h4>
                                        <p class="card-text">{{ $role->description }}</p>
                                    </div>
                                </div>
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection