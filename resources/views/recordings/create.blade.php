@extends('layouts.app')
@section('title', 'Phrase Hub')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        @include("partials.popup")
        <div class="col-md-8">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <p class="m-0">Phrases</p>
                    @can('language-list')
                        <span>
                            <a class="btn btn-primary" href="{{ route('recordings.index') }}">Back</a>
                        </span>
                    @endcan
                </div>
                @include('phrases.list', ['showRecordingButton' => true])
            </div>
        </div>
    </div>
</div>
@endsection