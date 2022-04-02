@extends("layouts.app")
@section("title", __("Manage Language"))
@section("content")
    <div class="container">
        <div class="row justify-content-center">
            @include("partials.popup")
            <div class="col-md-9">
                <div class="card">
                    @include("partials.card-header", [
                        "title" => "Manage Language",
                        "primaryButton" => [
                            "condition" => "language-list",
                            "url" => "home",
                            "text" => "Back",
                        ]
                    ])
                    <div class="card-body">
                        <form method="POST" action="{{ route('languages.updateVoice', $variant) }}">
                            @csrf
                            @method("PATCH")
                            <div class="form-group mb-2 d-flex justify-content-between">
                                <div class="language-dropdown-section">
                                    <label for="name">{{ __("Name") }}</label>
                                    <input class="form-control" type="text" name="name" value="{{ old('name') ?? $language->name }}" disabled />
                                </div>
                                <div class="language-variety-dropdown-section">
                                    <label for="language_voice">{{ __("Voice") }}</label>
                                    <select id="language_select_dropdown" name="language_voice" class="form-select" aria-label="Default select example">
                                        <option value="">{{ __("Select a voice") }}</option>
                                        @if (isset($language->voices))
                                            @foreach ($language->voices as $key => $voice)
                                                <option 
                                                    value="{{ $voice['id'] }}"
                                                    {{ $voice["id"] == $language->currentVoice ? "selected" : "" }}
                                                >{{ $voice["display_name"] }}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                            </div>
                            <div class="mb-2">
                                <small class="form-text text-muted">{{ __("A WaveNet voice synthesizes speech with more human-like emphasis and inflection on syllables, phonemes, and words.") }}</small>
                            </div>
                            <button type="submit" class="btn btn-primary">{{ __("Update") }}</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection