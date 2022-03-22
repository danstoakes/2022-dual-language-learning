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
                    @can('language-list')
                        <span>
                            <a class="btn btn-primary" href="{{ route('languages.index') }}">Back</a>
                        </span>
                    @endcan
                </div>
                @include('languages.list')
            </div>
        </div>
    </div>
</div>
@endsection