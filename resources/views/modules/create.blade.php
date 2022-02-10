@extends('layouts.app')
@section('title', 'Create Module')
@section('content')
<div class="container">
    <div class="justify-content-center">
        @include("partials.popup")
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <p class="m-0">Create Module</p>
                @can('language-list')
                    <span>
                        <a class="btn btn-primary" href="{{ url()->previous() }}">Back</a>
                    </span>
                @endcan
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('modules.store') }}">
                    @csrf
                    <input class="form-control" type="hidden" name="language_id" value="{{ $languageId }}" required />
                    <div class="form-group mb-2">
                        <label for="name">Name</label>
                        <input class="form-control" type="text" name="name" required />
                    </div>
                    <div class="form-group mb-2">
                        <label for="description">Description</label>
                        <textarea class="form-control" name="description" rows="4" required></textarea>
                    </div>
                    <div class="form-group mb-3">
                        <label for="logo">SVG Logo</label>
                        <textarea class="form-control" name="icon_svg" rows="4" required></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection