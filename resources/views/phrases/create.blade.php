@extends("layouts.app")
@section("title", "Add Phrase")
@section("content")
<div class="container">
    <div class="row justify-content-center">
        @include("partials.popup")
        <div class="col-md-9">
            <div class="card">
                @include("partials.card-header", [
                    "title" => "Add Phrase",
                    "primaryButton" => [
                        "condition" => "language-list",
                        "url" => "phrases.index",
                        "text" => "Back",
                    ]
                ])
                <div class="card-body">
                    <form method="POST" action="{{ route('phrases.store') }}">
                        @csrf
                        <div class="form-group mb-2">
                            <label for="phrase">Phrase</label>
                            <input class="form-control" name="phrase" type="text" value="{{ old('phrase') }}" required />
                        </div>
                        <div class="form-group mb-3 d-flex justify-content-between">
                            <div class="language-dropdown-section">
                                <label for="language_id">Language</label>
                                <select id="language_select_dropdown" name="language_id" class="form-select" aria-label="Default select example" required>
                                    <option value="">Select a language</option>
                                    @if (isset($languages))
                                        @foreach ($languages as $key => $language)
                                            <option 
                                                value="{{ $language->id }}"
                                                language_codes="{{ json_encode($language->codes()) }}"
                                                excerpt="{{ $language->excerpt }}"
                                                description="{{ $language->description }}"
                                                {{ old('language_id') == $language->id ? 'selected' : '' }}
                                            >{{ $language->name }}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                            {{--<div class="language-variety-dropdown-section">
                                <label for="region_id">Variant</label>
                                <select id="language_variant_select_dropdown" name="region_id" class="form-select" aria-label="Default select example" disabled>
                                </select>
                            </div>--}}
                        </div>
                        <div class="form-group d-flex mb-2">
                            <input style="margin-right: 0.5em" class="mt-auto mb-auto form-check-input" name="partner_phrase" type="checkbox" id="phrase_create_checkbox" />
                            <label for="partner_phrase">This phrase already exists in another language</label>
                        </div>
                        <div style="display: none" id="select_similar_section">
                            <label for="batch_id">Matching Phrase</label>
                            <select name="batch_id" class="form-select mb-2 appearance-none block w-full px-3 py-2 text-base font-normal text-gray-700 bg-white bg-clip-padding bg-no-repeat border border-solid border-gray-300 rounded focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none" aria-label="Default select example">
                                <option value="">Select a phrase</option>
                                @if (isset($phrases))
                                    @foreach ($phrases as $key => $phrase)
                                        <option value="{{ $phrase->batch_id }}">{{ $phrase->phrase }}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary mt-2">Add</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection