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
                            <a class="btn btn-primary" href="{{ route('languages.create') }}">New Language</a>
                        </span>
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
                                            <h5 class="card-title">{{ $language->name }}</h5>
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