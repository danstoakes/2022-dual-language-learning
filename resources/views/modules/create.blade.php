@extends("layouts.app")
@section("title", "Create Module")
@section("content")
<div class="container">
    <div class="row justify-content-center">
        @include("partials.popup")
        <div class="col-md-9">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <p class="m-0">Create Module</p>
                    @can("language-list")
                        <span>
                            <a class="btn btn-primary" href="{{ route('languages.show', $languageId) }}">Back</a>
                        </span>
                    @endcan
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('modules.store') }}">
                        @csrf
                        <input class="form-control" type="hidden" name="language_id" value="{{ $languageId }}" required />
                        <div class="form-group mb-2">
                            <label for="name">Name</label>
                            <input class="form-control" type="text" name="name" value="{{ old('name') }}" required />
                        </div>
                        <div class="form-group mb-2">
                            <label for="description">Description</label>
                            <textarea class="form-control" name="description" rows="4" maxlength="1024" oninput="changeCount(event, 'description_characters')" onfocus="changeCount(event, 'description_characters')" required>{{ old("description") }}</textarea>
                            <small id="description_characters" class="form-text text-muted"></small>
                        </div>
                        <div class="form-group mb-3">
                            <label for="logo">SVG Logo</label>
                            <textarea class="form-control" name="icon_svg" rows="4" placeholder="Optional">{{ old("icon_svg") }}</textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Create</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection