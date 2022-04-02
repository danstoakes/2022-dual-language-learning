@extends("layouts.app")
@section("title", __("Edit Language"))
@section("content")
    <div class="container">
        <div class="row justify-content-center">
            @include("partials.popup")
            <div class="col-md-9">
                <div class="card">
                    @include("partials.card-header", [
                        "title" => "Edit Language",
                        "primaryButton" => [
                            "condition" => "language-list",
                            "url" => "languages.show",
                            "data" => $language,
                            "text" => "Back"
                        ]
                    ])
                    <div class="card-body">
                        <form method="POST" action="{{ route('languages.update', $language) }}">
                            @csrf
                            @method("PATCH")
                            @include("atoms/form.input-name", [
                                "hasBottomMargin" => true, "data" => $language->name, "isRequired" => true
                            ])
                            <div class="form-group mb-2">
                                <label for="excerpt">{{ __("Excerpt") }}</label>
                                <input class="form-control" type="text" name="excerpt" maxlength="255" oninput="changeCount(event, 'excerpt_characters')" onfocus="changeCount(event, 'excerpt_characters')" value="{{ old('excerpt') ?? $language->excerpt }}" />
                                <small id="excerpt_characters" class="form-text text-muted"></small>
                            </div>
                            @include("atoms/form.input-description", [
                                "hasBottomMargin" => true, "isRequired" => true, 
                                "maxLength" => "1024", "data" => $language->description
                            ])
                            <div class="form-group mb-3">
                                <label for="logo">{{ __("SVG Logo") }}</label>
                                <textarea class="form-control" name="logo_path" rows="4" required>{{ old("logo_path") ?? $language->logo_path }}</textarea>
                            </div>
                            <button type="submit" class="btn btn-primary">{{ __("Update") }}</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection