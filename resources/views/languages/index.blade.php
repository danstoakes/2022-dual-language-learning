@extends('layouts.app')
@section('title', 'Language Hub')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        @include("partials.popup")
        <div class="col-md-9">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <p class="m-0">Languages</p>
                    @can('language-create')
                        <span>
                            <a class="btn btn-primary" href="{{ route('languages.create') }}">
                                <p class="text-icon-inline card-text">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 d-inline d-sm-none" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" clip-rule="evenodd" />
                                    </svg>
                                    <span class="d-none d-sm-inline">
                                        New Language
                                    </span>
                                </p>
                            </a>
                        </span>
                    @else
                        @can('language-list')
                            <span>
                                <a class="btn btn-primary" href="{{ route('languages.index') }}">Back</a>
                            </span>
                        @endcan
                    @endcan
                </div>
                <div class="card-body">
                    <div class="row">
                        @foreach($data as $key => $language)
                            <div class="{{ $key != count($data) - 1 ? 'mb-3' : '' }}">
                                <a href="{{ route('languages.show', $language->id) }}" class="text-decoration-none text-black">
                                    <div class="card flex flex-row align-items-center language-list-card">
                                        <span class="card-img-top rounded language-logo d-none d-lg-block">{!! $language->logo_path !!}</span>
                                        <div class="card-body language-details">
                                            <h4 class="card-title language-title language-title-large">{{ $language->name }} <span class="d-lg-none">{!! $language->logo_path !!}</span></h4>
                                            <p class="card-text">{{ $language->excerpt }}</p>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        @endforeach
                    </div>
                    {{ $data->appends($_GET)->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection