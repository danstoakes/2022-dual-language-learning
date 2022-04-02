@extends('layouts.app')
@section('title', $phrase->phrase)
@section('content')
<div class="container">
    <div class="row justify-content-center">
        @include("partials.popup")
        <div class="col-md-9">
            <div class="card">
                @include("partials.card-header", [
                    "title" => "Phrase",
                    "primaryButton" => [
                        "condition" => "phrase-delete",
                        "url" => "phrases.destroy",
                        "data" => $phrase,
                        "text" => "Delete",
                        "mobileIcon" => "atoms/icon.delete-symbol"
                    ],
                    "secondaryButton" => [
                        "condition" => "phrase-list",
                        "url" => "phrases.index",
                        "text" => "Back"
                    ]
                ])
                <div class="card-body table-responsive">
                    <div class="d-flex flex-column mb-2">
                        <div>
                            <h4 class="card-title language-title language-title-large }}">
                                {{ $phrase->phrase }}
                                @can('phrase-edit')
                                    <a href="{{ route('phrases.edit', $phrase) }}">
                                        @include("atoms/icon.edit-symbol")
                                    </a>
                                @endcan
                            </h4>
                            <p class="card-text language-title">{{ $phrase->getLanguageName() }} {!! $phrase->getLanguageFlag() !!}</p>
                        </div>
                    </div>
                    <div class="mt-3">
                        <h5 class="card-title">Related Phrases ({{ count($phrase->relatedPhrases()) }})</h5>
                        @if (count($phrase->relatedPhrases()) > 0)
                            <div class="lead">
                                @foreach($phrase->relatedPhrases() as $phrase)
                                    <label class="badge badge-success btn-primary">
                                        <a href="{{ route('phrases.show', $phrase) }}" class="text-white text-decoration-none">
                                            {{ $phrase->phrase }}
                                        </a>
                                    </label>
                                @endforeach
                            </div>
                        @else
                            <p class="text-icon-inline card-text">
                                @include("atoms/icon.caution-symbol")
                                There are no phrases to display.
                            </p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection