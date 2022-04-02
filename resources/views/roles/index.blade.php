@extends("layouts.app")
@section("title", __("Role Manager"))
@section("content")
    <div class="container">
        <div class="row justify-content-center">
            @include("partials.popup")
            <div class="col-md-9">
                <div class="card">
                    @include("partials.card-header", [
                        "title" => "Roles",
                        "primaryButton" => [
                            "condition" => "role-create",
                            "url" => "roles.create",
                            "text" => "New Role",
                            "mobileIcon" => "atoms/icon.plus-symbol"
                        ],
                        "secondaryButton" => ["isDefault" => true]
                    ])
                    <div class="card-body">
                        @foreach ($roles as $key => $role)
                            <div @class([
                                "mb-3" => !$loop->last
                            ])>
                                @include("partials.card", [
                                    "title" => $role->name,
                                    "text" => $role->description,
                                    "link" => [
                                        "url" => "roles.show", 
                                        "data" => $role
                                    ]
                                ])
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection