@extends('layouts.app')
@section('title', $permission->name)
@section('content')
<div class="container">
    <div class="row justify-content-center">
        @include("partials.popup")
        <div class="col-md-9">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <p class="m-0">Permission</p>
                    @can('permission-edit')
                        <span>
                            <a class="btn btn-primary" href="{{ route('permissions.edit', $permission->id) }}">Edit</a>
                        </span>
                    @else
                        @can('permission-list')
                            <span>
                                <a class="btn btn-primary" href="{{ route('permissions.index') }}">Back</a>
                            </span>
                        @endcan
                    @endcan
                </div>
                <div class="card-body">
                    <div class="d-flex flex-column">
                        <h4 class="card-title language-title language-title-large {{ $permission->description ? '' : 'mb-0' }}">{{ $permission->name }}</h4>
                        @if (isset($permission->description))
                            <p class="card-text">{{ $permission->description }}</p>
                        @endif
                    </div>
                </div>
            </div>
            <div class="d-flex justify-content-end">
                <small class="form-text text-muted">Last updated {{ $permission->updated_at->diffForHumans() }}</small>
            </div>
        </div>
    </div>
</div>
@endsection