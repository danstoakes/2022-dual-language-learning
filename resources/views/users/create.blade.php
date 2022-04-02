@extends("layouts.app")
@section("title", __("Create Users"))
@section("content")
    <div class="container">
        <div class="row justify-content-center">
            @include("partials.popup")
            <div class="col-md-9">
                <div class="card">
                    @include("partials.card-header", [
                        "title" => "Create User",
                        "primaryButton" => [
                            "condition" => "user-list",
                            "url" => "users.index",
                            "text" => "Back",
                        ]
                    ])
                    <div class="card-body">
                        <form method="POST" action="{{ route('users.store') }}">
                            @csrf
                            @include("atoms/form.input-name", [
                                "hasBottomMargin" => true, "isRequired" => true
                            ])
                            <div class="form-group mb-2">
                                <label for="email">{{ __("Email") }}</label>
                                <input class="form-control" type="text" name="email" value="{{ old('email') }}" required />
                            </div>
                            <div class="form-group mb-2">
                                <label for="password">{{ __("Password") }}</label>
                                <input class="form-control" type="password" name="password" required />
                            </div>
                            <div class="form-group mb-2">
                                <label for="password_confirmation">{{ __("Confirm Password") }}</label>
                                <input class="form-control" type="password" name="password_confirmation" required />
                            </div>
                            <div class="form-group mb-3">
                                <label for="role">{{ __("Role") }}</label>
                                <select name="role" class="form-control form-select form-select-md" required>
                                    <option>Select a role</option>
                                    @if (isset($roles))
                                        @foreach ($roles as $key => $role)
                                            <option value="{{ $role->id }}">{{ __($role->name) }}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                            <button type="submit" class="btn btn-primary">{{ __("Create") }}</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection