@extends("layouts.app")
@section("title", "Edit Module")
@section("content")
<div class="container">
    <div class="row justify-content-center">
        @include("partials.popup")
        <div class="col-md-9">
            <div class="card">
                @include("partials.card-header", [
                    "title" => "Edit Module",
                    "primaryButton" => [
                        "condition" => "language-list",
                        "url" => "languages.show",
                        "data" => $module->language_id,
                        "text" => "Back",
                    ]
                ])
                <div class="card-body">
                    <form method="POST" action="{{ route('modules.update', $module->id) }}">
                        @csrf
                        @method("PATCH")
                        @include("atoms/form.input-name", [
                            "hasBottomMargin" => true, "data" => $module->name, "isRequired" => true
                        ])
                        @include("atoms/form.input-description", [
                            "hasBottomMargin" => true, "isRequired" => true, 
                            "maxLength" => "1024", "data" => $module->description
                        ])
                        <div class="form-group mb-3">
                            <label for="logo">SVG Logo</label>
                            <textarea class="form-control" name="icon_svg" rows="4" required>{{ old("icon_svg") ?? $module->icon_svg }}</textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Update</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection