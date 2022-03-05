@extends('layouts.app')
@section('title', 'Create Permission')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        @include("partials.popup")
        <div class="col-md-9">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <p class="m-0">Create Permission</p>
                    @can('permission-list')
                        <span>
                            <a class="btn btn-primary" href="{{ route('permissions.index') }}">Back</a>
                        </span>
                    @endcan
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('permissions.store') }}">
                        @csrf
                        <div class="form-group mb-3">
                            <label for="name">Name</label>
                            <input class="form-control" type="text" name="name" value="{{ old('name') }}" required />
                        </div>
                        <button type="submit" class="btn btn-primary">Create</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection