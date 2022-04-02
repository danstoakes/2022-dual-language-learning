@extends("layouts.app")
@section("title", __("Edit Role"))
@section("content")
    <div class="container">
        <div class="row justify-content-center">
            @include("partials.popup")
            <div class="col-md-9">
                <div class="card">
                    @include("partials.card-header", [
                        "title" => "Edit Role",
                        "primaryButton" => [
                            "condition" => "role-list",
                            "url" => "roles.show",
                            "text" => "Back",
                        ]
                    ])
                    <div class="card-body">
                        <form method="POST" action="{{ route('roles.update', $role->id) }}">
                            @csrf
                            @method("PATCH")
                            @include("atoms/form.input-name", [
                                "hasBottomMargin" => true, "data" => $role->name, "isRequired" => true
                            ])
                            @include("atoms/form.input-description", [
                                "hasBottomMargin" => true, "isRequired" => true, 
                                "maxLength" => "128", "data" => $role->description
                            ])
                            <div class="form-group mb-3">
                                <p class="mb-1">{{ __("Manage Permissions") }}</p>
                                @foreach ($permissions as $key => $permission)
                                    <div class="form-check form-switch mb-0 {{ $key > 0 ? 'mt-2' : '' }}">
                                        <input {{ $role->permissions->contains($permission) ? 'checked' : '' }} class="form-check-input" type="checkbox" name="permission[]" value="{{ $permission->id }}">
                                        <label class="form-check-label" for="flexSwitchCheckChecked">{{ __($permission->name) }}</label>
                                    </div>
                                    <small class="form-text text-muted">{{ __($permission->description) }}</small>
                                @endforeach
                            </div>
                            <button type="submit" class="btn btn-primary"> {{ __("Update") }}</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection