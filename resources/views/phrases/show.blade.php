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
                @if (count($phrase->relatedPhrases()) > 0)
                    <div class="card-body table-responsive">
                        <div class="d-flex flex-column mb-2">
                            <div>
                                <h4 class="card-title">{{ $phrase->phrase }}</h4>
                                <p class="card-text language-title">{{ $phrase->getLanguageName() }} {!! $phrase->getLanguageFlag() !!}</p>
                            </div>
                        </div>
                        <table class="table table-hover">
                            <thead class="thead-dark">
                                <tr>
                                    <th>Related phrases</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($phrase->relatedPhrases() as $phrase)
                                    <tr class="align-middle">
                                    <td>{{ $phrase->phrase }}</td>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="card-body">
                        <div class="d-flex flex-column mb-2">
                            <div>
                                <h4 class="card-title">{{ $phrase->phrase }}</h4>
                                <p class="card-text language-title">{{ $phrase->getLanguageName() }} {!! $phrase->getLanguageFlag() !!}</p>
                            </div>
                        </div>
                        <h5 class="card-title">Related Phrases ({{ count($phrase->relatedPhrases()) }})</h5>
                        <p class="text-icon-inline card-text">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                            </svg>
                            There are no phrases to display.
                        </p>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection