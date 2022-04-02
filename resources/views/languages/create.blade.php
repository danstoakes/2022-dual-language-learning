@extends("layouts.app")
@section("title", __("Add Language"))
@section("content")
    <div class="container">
        <div class="row justify-content-center">
            @include("partials.popup")
            <div class="col-md-9">
                <div class="card">
                    @include("partials.card-header", [
                        "title" => "Add Language",
                        "primaryButton" => [
                            "condition" => "language-list",
                            "url" => "home",
                            "text" => "Back"
                        ]
                    ])
                    <div class="card-body">
                        <form method="POST" action="{{ route('languages.store') }}">
                            @csrf
                            <div class="form-group mb-2 d-flex justify-content-between">
                                <div class="language-dropdown-section">
                                    <label for="language_id">{{ __("Language") }}</label>
                                    <select id="language_select_dropdown" name="language_id" class="form-select" aria-label="Default select example" required>
                                        <option value="">{{ __("Select a language") }}</option>
                                        @if (isset($supportedLanguages))
                                            @foreach ($supportedLanguages as $key => $language)
                                                <option 
                                                    value="{{ $language->id }}"
                                                    language_codes="{{ json_encode($language->codes) }}"
                                                    excerpt="{{ $language->excerpt }}"
                                                    description="{{ $language->description }}"
                                                >{{ __($language->name) }}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                                <div class="language-variety-dropdown-section">
                                    <label for="region_id">{{ __("Variant") }}</label>
                                    <select id="language_variant_select_dropdown" name="region_id" class="form-select" aria-label="Default select example" disabled>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group mb-2">
                                <label for="excerpt">{{ __("Excerpt") }} </label>
                                <input id="language_select_excerpt" class="form-control" type="text" name="excerpt" maxlength="255" oninput="changeCount(event, 'excerpt_characters')" onfocus="changeCount(event, 'excerpt_characters')" value="{{ old('excerpt') }}" disabled/>
                                <small id="excerpt_characters" class="form-text text-muted"></small>
                            </div>
                            @include("atoms/form.input-description", [
                                "hasBottomMargin" => true, "isRequired" => true, "maxLength" => "1024"
                            ])
                            <button type="submit" class="btn btn-primary">{{ __("Add") }}</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection