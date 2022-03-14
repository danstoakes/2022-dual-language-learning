<!--
    List all phrases, with them being grouped by their batch_id.

    How much does it cost?
    Wie viel kostet es?
    Hur mycket kostet det?

    Where are you from?
    Woher kommen Sie?
    Var kommer du ifrån?

    Could feature a little flag for the country of origin of each phrase.
-->

@extends('layouts.app')
@section('title', 'Phrase Hub')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        @include("partials.popup")
        <div class="col-md-9">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <p class="m-0">Phrases</p>
                    @can('phrase-create')
                        <span>
                            <a class="btn btn-primary" href="{{ route('phrases.create') }}">
                                <p class="text-icon-inline card-text">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 d-inline d-sm-none" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" clip-rule="evenodd" />
                                    </svg>
                                    <span class="d-none d-sm-inline">
                                        New Phrase
                                    </span>
                                </p>
                            </a>
                        </span>
                    @else
                        @can('phrase-list')
                            <span>
                                <a class="btn btn-primary" href="{{ route('phrases.index') }}">Back</a>
                            </span>
                        @endcan
                    @endcan
                </div>
                @include('phrases.list', ['showRecordingButton' => false])
            </div>
        </div>
    </div>
</div>
@endsection