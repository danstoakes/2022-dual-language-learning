@extends('layouts.app')
@section('title', $role->name)
@section('content')
<div class="container">
    <div class="row justify-content-center">
        @include("partials.popup")
        <div class="col-md-9">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <p class="m-0">Role</p>
                    @can('role-delete')
                        <form method="POST" action="{{ route('roles.destroy', $role) }}" class="ms-2">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-primary">
                                <p class="text-icon-inline card-text">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 d-inline d-sm-none" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                    </svg>
                                    <span class="d-none d-sm-inline">
                                        Delete
                                    </span>
                                </p>
                            </button>
                        </form>
                    @else
                        @can('role-list')
                            <span>
                                <a class="btn btn-primary" href="{{ route('roles.index') }}">Back</a>
                            </span>
                        @endcan
                    @endcan
                </div>
                <div class="card-body">
                    <div class="d-flex flex-column">
                        <h4 class="card-title language-title language-title-large">
                            {{ $role->name }}
                            <a href="{{ route('roles.edit', $role) }}">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20">
                                    <path d="M17.414 2.586a2 2 0 00-2.828 0L7 10.172V13h2.828l7.586-7.586a2 2 0 000-2.828z" />
                                    <path fill-rule="evenodd" d="M2 6a2 2 0 012-2h4a1 1 0 010 2H4v10h10v-4a1 1 0 112 0v4a2 2 0 01-2 2H4a2 2 0 01-2-2V6z" clip-rule="evenodd" />
                                </svg>
                            </a>
                        </h4>
                    </div>
                    @if(isset($rolePermissions) && count($rolePermissions) > 0)
                        <div class="lead">
                            @foreach($rolePermissions as $permission)
                                <label class="badge badge-success btn-primary">{{ $permission->name }}</label>
                            @endforeach
                        </div>
                    @else
                        <p class="mb-0">No permissions set.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection