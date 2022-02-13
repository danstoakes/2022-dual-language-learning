@extends('layouts.app')
@section('title', 'Create Language')
@section('content')
<div class="container">
    <div class="justify-content-center">
        @include("partials.popup")
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <p class="m-0">Create Language</p>
                @can('language-list')
                    <span>
                        <a class="btn btn-primary" href="{{ route('languages.index') }}">Back</a>
                    </span>
                @endcan
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('languages.store') }}">
                    @csrf
                    <div class="form-group mb-2">
                        <label for="name">Name</label>
                        <input class="form-control" type="text" name="name" required />
                    </div>
                    <div class="form-group mb-2">
                        <label for="excerpt">Excerpt</label>
                        <input class="form-control" type="text" name="excerpt" required />
                    </div>
                    <div class="form-group mb-2">
                        <label for="description">Description</label>
                        <textarea class="form-control" name="description" rows="4" required></textarea>
                    </div>
                    <div class="form-group mb-3">
                        <label for="logo_path">SVG Logo</label>
                        <textarea class="form-control" name="logo_path" rows="4" required></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection