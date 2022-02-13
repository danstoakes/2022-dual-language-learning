@extends('layouts.app')
@section('title', 'Language Hub')
@section('content')
<div class="container">
    <div class="row justify-content-center"> <!-- row -->
        @include("partials.popup")
        <div class="col-md-9">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <p class="m-0">Languages</p>
                    @can('language-create')
                        <span>
                            <a class="btn btn-primary" href="{{ route('languages.create') }}">New Language</a>
                        </span>
                    @endcan
                </div>
                <div class="card-body">
                    <div class="col-md-12 {{ $data->appends($_GET)->hasPages() ? 'mb-3' : '' }}">
                        <div class="row">
                            @foreach($data as $key => $language)
                                <div class="col-sm-6 col-md-4 {{ $loop->index % 3 == 0 && $loop->count - ($loop->index + 1) > 3 ? 'mb-4' : '' }}">
                                    <div class="card">
                                        <span class="card-img-top rounded">{!! $language->logo_path !!}</span>
                                        <div class="card-body">
                                            <h5 class="card-title">{{ $language->name }}</h5>
                                            <p class="card-text">{{ $language->excerpt }}</p>
                                            <a href="{{ route('languages.show', $language->id) }}" class="btn btn-primary">{{ __("View") }}</a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    {{ $data->appends($_GET)->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection