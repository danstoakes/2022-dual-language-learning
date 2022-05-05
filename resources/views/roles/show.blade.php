@extends("layouts.app")
@section("title", __($role->name))
@section("content")
    <div class="container">
        <div class="row justify-content-center">
            @include("partials.popup")
            <div class="col-md-9">
                <div class="card">
                    @include("partials.card-header", [
                        "title" => "Role",
                        "primaryButton" => [
                            "condition" => "role-delete",
                            "url" => "roles.destroy",
                            "data" => $role,
                            "text" => "Delete",
                            "mobileIcon" => "atoms/icon.delete-symbol"
                        ],
                        "secondaryButton" => [
                            "condition" => "role-list",
                            "url" => "roles.index",
                            "text" => "Back"
                        ]
                    ])
                    <div class="card-body">
                        <div class="d-flex flex-column">
                            <h4 class="card-title language-title language-title-large">
                                {{ __($role->name) }}
                                @can("role-edit")
                                    <a href="{{ route('roles.edit', $role) }}">
                                        @include("atoms/icon.edit-symbol")
                                    </a>
                                @endcan
                            </h4>
                        </div>
                        @if(isset($rolePermissions) && count($rolePermissions) > 0)
                            <div class="lead">
                                @foreach($rolePermissions as $permission)
                                    <label class="badge badge-success btn-primary">
                                        @can("permission-list")
                                            <a href="{{ route('permissions.show', $permission) }}" class="text-white text-decoration-none">
                                                {{ __($permission->name) }}
                                            </a>
                                        @else
                                            {{ __($permission->name) }}
                                        @endcan
                                    </label>
                                @endforeach
                            </div>
                        @else
                            <p class="mb-0">{{ __("No permissions set.") }}</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection