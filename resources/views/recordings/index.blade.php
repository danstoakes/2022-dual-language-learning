@extends('layouts.app')
@section('title', 'Recording Hub')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
        <div class="card mb-3">
            <div class="card-header d-flex justify-content-between align-items-center">
                <p class="m-0">Recordings</p>
                @can('language-create')
                    <span>
                        <a class="btn btn-primary" href="{{ route('recordings.create') }}">Manage</a>
                    </span>
                @endcan
            </div>
            <div class="card-body mb-n3">
                <div class="row">
                    @foreach ($recordings as $key=>$recording)
                        <div class="col-lg-2 col-4 mb-3 mb-lg-3 mb-lg-0 mb-0">
                            <div class="card music-container">
                                <div class="card-body music-container-body">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19V6l12-3v13M9 19c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zm12-3c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zM9 10l12-3" />
                                    </svg>
                                </div>
                                <div class="music-container-overlay">
                                    <audio class="recording-audio">
                                        <source src="{{ URL::asset('storage/' . $recording->file_name) }}" type="audio/mpeg">
                                    </audio>
                                    <div class="music-container-overlay-circle">
                                        <svg id="recording_play_pause" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM9.555 7.168A1 1 0 008 8v4a1 1 0 001.555.832l3-2a1 1 0 000-1.664l-3-2z" clip-rule="evenodd" />
                                            <path style="display: none;" fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zM7 8a1 1 0 012 0v4a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v4a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd" />
                                        </svg>
                                    </div>
                                </div>
                            </div>
                            <div class="music-container-label">
                                <p class="mb-1">{{ $recording->file_name }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
        {{ $recordings->appends($_GET)->links() }}
    </div>
</div>
@endsection
