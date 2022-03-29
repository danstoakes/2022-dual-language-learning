@extends("layouts.app")
@section("title", "Add Language")
@section("content")
<div class="container">
    <div class="row justify-content-center">
        @include("partials.popup")
        <div class="col-md-9">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <p class="m-0">Add Language</p>
                    @can('language-list')
                        <span>
                            <a class="btn btn-primary" href="{{ route('home') }}">Back</a>
                        </span>
                    @endcan
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('languages.store') }}">
                        @csrf
                        <div class="form-group mb-2 d-flex justify-content-between">
                            <div class="language-dropdown-section">
                                <label for="language_id">Language</label>
                                <select id="language_select_dropdown" name="language_id" class="form-select" aria-label="Default select example" required>
                                    <option value="">Select a language</option>
                                    @if (isset($supportedLanguages))
                                        @foreach ($supportedLanguages as $key => $language)
                                            <option 
                                                value="{{ $language->id }}"
                                                language_codes="{{ json_encode($language->codes) }}"
                                                excerpt="{{ $language->excerpt }}"
                                                description="{{ $language->description }}"
                                            >{{ $language->name }}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                            <div class="language-variety-dropdown-section">
                                <label for="region_id">Variant</label>
                                <select id="language_variant_select_dropdown" name="region_id" class="form-select" aria-label="Default select example" disabled>
                                </select>
                            </div>
                        </div>
                        <div class="form-group mb-2">
                            <label for="excerpt">Excerpt</label>
                            <input id="language_select_excerpt" class="form-control" type="text" name="excerpt" maxlength="255" oninput="changeCount(event, 'excerpt_characters')" onfocus="changeCount(event, 'excerpt_characters')" value="{{ old('excerpt') }}" disabled/>
                            <small id="excerpt_characters" class="form-text text-muted"></small>
                        </div>
                        <div class="form-group mb-3">
                            <label for="description">Description</label>
                            <textarea id="language_select_description" class="form-control" name="description" rows="4" maxlength="1024" oninput="changeCount(event, 'description_characters')" onfocus="changeCount(event, 'description_characters')" disabled>{{ old("description") }}</textarea>
                            <small id="description_characters" class="form-text text-muted"></small>
                        </div>
                        <button type="submit" class="btn btn-primary">Add</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection