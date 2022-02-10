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
                            <h4 class="card-title">{{ $language->name }}</h4>
                            <p class="card-text">{{ $language->description }}</p>
                        </div>
                        <!-- <div>
                            {!! $language->logo_path !!}
                        </div> -->
                        <div class="mt-3">
                            <h5 class="card-title">Modules ({{ count($modules) }})</h5>

                            @foreach ($modules as $module)
                                <a href="{{ route('modules.show', $module['id']) }}">{{ $module["name"] }}</a>                            
                            @endforeach
                        </div>
                        <div class="mt-3">
                            <a class="btn btn-primary" href="{{ route('modules.create', $language->id) }}">Create Module</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection