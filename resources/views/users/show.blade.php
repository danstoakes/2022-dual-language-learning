@extends("layouts.app")
@section("title", __($user->name))
@section("content")
    <div class="container">
        <div class="row justify-content-center">
            @include("partials.popup")
            <div class="col-md-9">
                <div class="card">
                    @include("partials.card-header", [
                        "title" => "User",
                        "primaryButton" => [
                            "condition" => "user-delete",
                            "url" => "users.destroy",
                            "data" => $user,
                            "text" => "Delete",
                            "mobileIcon" => "atoms/icon.delete-symbol"
                        ],
                        "secondaryButton" => [
                            "condition" => "user-list",
                            "url" => "users.index",
                            "text" => "Back"
                        ]
                    ])
                    <div class="card-body">
                        <div class="d-flex flex-column">
                            <h4 class="card-title language-title language-title-large {{ $user->email ? '' : 'mb-0' }}">
                                {{ __($user->name) }}
                                @can("user-edit")
                                    <a href="{{ route('users.edit', $user) }}">
                                        @include("atoms/icon.edit-symbol")
                                    </a>
                                @endcan
                            </h4>
                            <p class="card-text">{{ __($user->email) }}</p>
                        </div>
                    </div>
                </div>
                <div class="d-flex justify-content-end">
                    <small class="form-text text-muted">{{ __("Last updated " . $user->updated_at->diffForHumans()) }}</small>
                </div>
            </div>
        </div>
    </div>
@endsection