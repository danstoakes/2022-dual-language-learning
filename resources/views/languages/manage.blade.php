@extends('layouts.app')
@section('title', 'Manage Language')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        @include("partials.popup")
        <div class="col-md-9">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <p class="m-0">Manage Language</p>
                    @can('language-list')
                        <span>
                            <a class="btn btn-primary" href="{{ route('home') }}">Back</a>
                        </span>
                    @endcan
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('languages.updateVoice', $variant) }}">
                        @csrf
                        @method('PATCH')
                        <div class="form-group mb-2 d-flex justify-content-between">
                            <div class="language-dropdown-section ">
                                <label for="name">Name</label>
                                <input class="form-control" type="text" name="name" value="{{ old('name') ?? $language->name }}" disabled />
                            </div>
                            <div class="language-variety-dropdown-section">
                                <label for="language_voice">Voice</label>
                                <select id="language_select_dropdown" name="language_voice" class="form-select" aria-label="Default select example">
                                    <option value="">Select a voice</option>
                                    @if (isset($language->voices))
                                        @foreach ($language->voices as $key => $voice)
                                            <option 
                                                value="{{ $voice['id'] }}"
                                                {{ $voice['id'] == $language->currentVoice ? 'selected' : '' }}
                                            >{{ $voice['display_name'] }}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                        </div>
                        <div class="mb-2">
                            <small class="form-text text-muted">A WaveNet voice synthesizes speech with more human-like emphasis and inflection on syllables, phonemes, and words.</small>
                        </div>
                        <button type="submit" class="btn btn-primary">Update</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection