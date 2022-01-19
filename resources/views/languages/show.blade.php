@extends('layouts.app')
@section('title', $language->name)
@section('content')
<div class="container">
    <div class="row justify-content-center">
        @include("partials.popup")
        <div class="col-md-9">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <p class="m-0">Language</p>
                    @can('language-list')
                        <span>
                            <a class="btn btn-primary" href="{{ route('languages.edit', $language->id) }}">Edit</a>
                        </span>
                    @endcan
                </div>
                <div class="card-body">
                    <div class="d-flex flex-column">
                        <div>
                            <h5 class="card-title">{{ $language->name }}</h5>
                            <p class="card-text">{{ $language->description }}</p>
                        </div>
                        <!-- <div>
                            {!! $language->logo_path !!}
                        </div> -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection