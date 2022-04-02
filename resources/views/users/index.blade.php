@extends("layouts.app")
@section("title", __("User Hub"))
@section("content")
    <div class="container">
        <div class="row justify-content-center">
            @include("partials.popup")
            <div class="col-md-9">
                <div class="card">
                    @include("partials.card-header", [
                        "title" => "Users",
                        "primaryButton" => [
                            "condition" => "user-create",
                            "url" => "users.create",
                            "text" => "New User",
                            "mobileIcon" => "atoms/icon.plus-symbol"
                        ],
                        "secondaryButton" => ["isDefault" => true]
                    ])
                    <div class="card-body">
                        @foreach ($users as $key => $user)
                            <div @class([
                                "mb-3" => !$loop->last
                            ])>
                                @include("partials.card", [
                                    "title" => $user->name,
                                    "text" => $user->email,
                                    "tag" => $user->getRole(),
                                    "link" => [
                                        "url" => "users.show", 
                                        "data" => $user
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