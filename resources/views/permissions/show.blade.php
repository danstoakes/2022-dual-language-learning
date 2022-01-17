@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        @include("partials.popup")
        <div class="col-md-9">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <p class="m-0">Permission</p>
                    @can('permission-list')
                        <span>
                            <a class="btn btn-primary" href="{{ route('permissions.index') }}">Back</a>
                        </span>
                    @endcan
                </div>
                <div class="card-body">
                    <div class="lead">
                        <strong>Name:</strong>
                        {{ $permission->name }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection