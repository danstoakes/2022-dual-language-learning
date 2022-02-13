@extends('layouts.app')
@section('title', $phrase->phrase)
@section('content')
<div class="container">
    <div class="row justify-content-center">
        @include("partials.popup")
        <div class="col-md-9">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <p class="m-0">Phrase</p>
                    @can('language-list')
                        <span>
                            @can('language-edit')
                                <a class="btn btn-primary" href="{{ route('phrases.edit', $phrase->id) }}">Edit</a>
                            @endcan
                        </span>
                    @endcan
                </div>
                <div class="card-body">
                    <div class="lead">
                        <strong>Content:</strong>
                        {{ $phrase->phrase }}
                    </div>
                    <div class="lead">
                        <strong>Language:</strong>
                        {{ $phrase->getLanguageName() }}
                    </div>
                    <div class="lead">
                        <strong>Related phrases:</strong>
                        @foreach ($phrase->relatedPhrases() as $phrase)
                            <div class="d-flex">
                                <p>{!! $phrase->getLogoSVG() !!}</p>
                                <p>{{ $phrase->phrase }}</p>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection