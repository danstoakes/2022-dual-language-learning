@extends('layouts.app')
@section('title', 'Edit Language')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        @include("partials.popup")
        <div class="col-md-9">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <p class="m-0">Edit Language</p>
                    @can('language-list')
                        <span>
                            <a class="btn btn-primary" href="{{ route('languages.show', $language->id) }}">Back</a>
                        </span>
                    @endcan
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('languages.update', $language->id) }}">
                        @csrf
                        @method('PATCH')
                        <div class="form-group mb-2">
                            <label for="name">Name</label>
                            <input class="form-control" type="text" name="name" value="{{ $language->name }}" required />
                        </div>
                        <div class="form-group mb-2">
                            <label for="excerpt">Excerpt</label>
                            <input class="form-control" type="text" name="excerpt" value="{{ $language->excerpt }}" required />
                        </div>
                        <div class="form-group mb-2">
                            <label for="description">Description</label>
                            <textarea class="form-control" name="description" rows="4">{{ $language->description }}</textarea>
                        </div>
                        <div class="form-group mb-3">
                            <label for="logo">SVG Logo</label>
                            <textarea class="form-control" name="logo_path" rows="4" required>{{ $language->logo_path }}</textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection