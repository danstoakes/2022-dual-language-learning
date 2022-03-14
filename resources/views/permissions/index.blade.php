@extends('layouts.app')
@section('title', 'Permission Centre')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        @include("partials.popup")
        <div class="col-md-9">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <p class="m-0">Permissions</p>
                    @can('permission-create')
                        <span>
                            <a class="btn btn-primary" href="{{ route('permissions.create') }}">
                                <p class="text-icon-inline card-text">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 d-inline d-sm-none" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" clip-rule="evenodd" />
                                    </svg>
                                    <span class="d-none d-sm-inline">
                                        New Permission
                                    </span>
                                </p>
                            </a>
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
                    @can('permission-list')
                        <div class="mb-3">
                            @for ($i = 0; $i < count($data); $i+=2)
                                <div class="row mb-0 {{ $i != count($data) - 2 ? 'mb-sm-4' : '' }}">
                                    @include("permissions.card", [
                                        "permission" => $data[$i],
                                        "lastCard" => $i == ($data->count() - 1)
                                    ])
                                    @if ($i + 1 < count($data))
                                        @include("permissions.card", [
                                            "permission" => $data[$i + 1],
                                            "lastCard" => ($i + 1) == ($data->count() - 1)
                                        ])
                                    @endif
                                </div>
                            @endfor
                        </div>
                        {{ $data->appends($_GET)->links() }}
                    @else
                        <p class="mb-0">You are not allowed to view permissions.</p>
                    @endcan
                </div>
            </div>
        </div>
    </div>
</div>
@endsection