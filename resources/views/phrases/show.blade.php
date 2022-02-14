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
            </div>
        </div>
    </div>
</div>
@endsection