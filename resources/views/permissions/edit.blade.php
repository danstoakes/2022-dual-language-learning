@extends('layouts.app')
@section('title', 'Edit Permission')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        @include("partials.popup")
        <div class="col-md-9">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <p class="m-0">Edit Permission</p>
                    @can('permission-list')
                        <span>
                            <a class="btn btn-primary" href="{{ route('permissions.index') }}">Back</a>
                        </span>
                    @endcan
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('permissions.update', $permission->id) }}">
                        @csrf
                        @method("PATCH")
                        <div class="form-group mb-3">
                            <label for="name">Name</label>
                            <input class="form-control" type="text" name="name" value="{{ old('name') ?? $permission->name }}" required />
                        </div>
                        <div class="form-group mb-3">
                            <label for="description" class="form-label">Description</label>
                            <input class="form-control" list="datalistOptions" name="description" placeholder="Optional" maxlength="255" value="{{ old('description') ?? $permission->description }}" oninput="changeCount(event, 'excerpt_characters')" onfocus="changeCount(event, 'excerpt_characters')">
                            <datalist id="datalistOptions">
                                @if (isset($descriptions))
                                    @foreach ($descriptions as $description)
                                        <option value="{{ $description }}">{{ $description }}</option>
                                    @endforeach
                                @endif
                            </datalist>
                            <small id="excerpt_characters" class="form-text text-muted"></small>
                        </div>
                        <button type="submit" class="btn btn-primary">Update</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection