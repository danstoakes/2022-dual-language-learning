@extends("layouts.app")
@section("title", "Edit Phrase")
@section("content")
    <div class="container">
        <div class="row justify-content-center">
            @include("partials.popup")
            <div class="col-md-9">
                <div class="card">
                    @include("partials.card-header", [
                        "title" => "Edit Phrase",
                        "primaryButton" => [
                            "condition" => "phrase-list",
                            "url" => "phrases.show",
                            "data" => $phrase,
                            "text" => "Back",
                        ]
                    ])
                    <div class="card-body">
                        <form method="POST" action="{{ route('phrases.update', $phrase) }}">
                            @csrf
                            @method("PUT")
                            <div class="form-group mb-2">
                                <label for="phrase">Phrase</label>
                                <input class="form-control" name="phrase" type="text" value="{{ $phrase->phrase }}" required />
                            </div>
                            <div class="form-group">
                                <label for="language_id">Language</label>
                                <select name="language_id" class="form-select mb-4 appearance-none block w-full px-3 py-2 text-base font-normal text-gray-700 bg-white bg-clip-padding bg-no-repeat border border-solid border-gray-300 rounded focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none" aria-label="Default select example" required>
                                    <option value="">Select a language</option>
                                    @if (isset($languages))
                                        @foreach ($languages as $key => $language)
                                            <option {{ $language->id == $phrase->language_id ? "selected" : "" }} value="{{ $language->id }}">{{ $language->name }}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                            <div class="form-group negative-margin-top mb-2 d-flex">
                                <input {{ count($phrase->relatedPhrases()) > 0 ? "checked" : "" }} style="margin-right: 0.5em" class="mt-auto mb-auto form-check-input" name="partner_phrase" type="checkbox" id="phrase_create_checkbox" />
                                <label for="partner_phrase">This phrase already exists in another language</label>
                            </div>
                            <div style="{{ count($phrase->relatedPhrases()) > 0 ? '' : 'display: none' }}" id="select_similar_section">
                                <label for="batch_id">Matching Phrase</label>
                                <select name="batch_id" class="form-select mb-2 appearance-none block w-full px-3 py-2 text-base font-normal text-gray-700 bg-white bg-clip-padding bg-no-repeat border border-solid border-gray-300 rounded focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none" aria-label="Default select example">
                                    <option value="">Select a phrase</option>
                                    @if (isset($phrases))
                                        @foreach ($phrases as $key => $phraseMatch)
                                            <option {{ $phraseMatch->batch_id == $phrase->batch_id ? "selected" : "" }} value="{{ $phraseMatch->batch_id }}">{{ $phraseMatch->phrase }}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                            <button type="submit" class="btn btn-primary mt-2">Update</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection