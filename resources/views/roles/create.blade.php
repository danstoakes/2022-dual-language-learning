@extends("layouts.app")
@section("title", __("Create Role"))
@section("content")
    <div class="container">
        <div class="row justify-content-center">
            @include("partials.popup")
            <div class="col-md-9">
                <div class="card">
                    @include("partials.card-header", [
                        "title" => "Create Role",
                        "primaryButton" => [
                            "condition" => "role-list",
                            "url" => "roles.index",
                            "text" => "Back",
                        ]
                    ])
                    <div class="card-body">
                        <form method="POST" action="{{ route('roles.store') }}">
                            @csrf
                            @include("atoms/form.input-name", [
                                "hasBottomMargin" => true, "isRequired" => true
                            ])
                            @include("atoms/form.input-description", [
                                "hasBottomMargin" => true, "isRequired" => true, "maxLength" => "128"
                            ])
                            <div class="form-group mb-3">
                                <p class="mb-1">{{ __("Set Permissions") }}</p>
                                @foreach ($permissions as $key => $permission)
                                    <div class="form-check form-switch mb-0 {{ $key > 0 ? 'mt-2' : '' }}">
                                        <input class="form-check-input" name="permission[]" type="checkbox" value="{{ $permission->id }}">
                                        <label class="form-check-label" for="flexSwitchCheckChecked">{{ __($permission->name) }}</label>
                                    </div>
                                    <small class="form-text text-muted">{{ __($permission->description) }}</small>
                                @endforeach
                            </div>
                            <button type="submit" class="btn btn-primary">{{ __("Create") }}</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection