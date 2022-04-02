@extends('layouts.app')
@section('title', $permission->name)
@section('content')
<div class="container">
    <div class="row justify-content-center">
        @include("partials.popup")
        <div class="col-md-9">
            <div class="card">
                @include("partials.card-header", [
                    "title" => "Permission",
                    "primaryButton" => [
                        "condition" => "permission-delete",
                        "url" => "permissions.destroy",
                        "data" => $permission,
                        "text" => "Delete",
                        "mobileIcon" => "atoms/icon.delete-symbol"
                    ],
                    "secondaryButton" => [
                        "condition" => "permission-list",
                        "url" => "permissions.index",
                        "text" => "Back"
                    ]
                ])
                <div class="card-body">
                    <div class="d-flex flex-column">
                        <h4 class="card-title language-title language-title-large {{ $permission->description ? '' : 'mb-0' }}">
                            {{ __($permission->name) }}
                            @can("permission-edit")
                                <a href="{{ route('permissions.edit', $permission) }}">
                                    @include("atoms/icon.edit-symbol")
                                </a>
                            @endcan
                        </h4>
                        @if (isset($permission->description))
                            <p class="card-text">{{ __($permission->description) }}</p>
                        @endif
                    </div>
                </div>
            </div>
            <div class="d-flex justify-content-end">
                <small class="form-text text-muted">{{ __("Last updated " . $permission->updated_at->diffForHumans()) }}</small>
            </div>
        </div>
    </div>
</div>
@endsection