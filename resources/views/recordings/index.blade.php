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
            @include('recordings.list')
        </div>
    </div>
</div>
@endsection
