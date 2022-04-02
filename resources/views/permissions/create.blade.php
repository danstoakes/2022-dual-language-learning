@extends("layouts.app")
@section("title", "Create Permission")
@section("content")
<div class="container">
    <div class="row justify-content-center">
        @include("partials.popup")
        <div class="col-md-9">
            <div class="card">
                @include("partials.card-header", [
                    "title" => "Create Permission",
                    "primaryButton" => [
                        "condition" => "permission-list",
                        "url" => "permissions.index",
                        "text" => "Back",
                    ]
                ])
                <div class="card-body">
                    <form method="POST" action="{{ route('permissions.store') }}">
                        @csrf
                        @include("atoms/form.input-name", [
                            "hasBottomMargin" => true, "isRequired" => true
                        ])
                        <div class="form-group mb-3">
                            <label for="description" class="form-label">Description</label>
                            <input class="form-control" list="datalistOptions" name="description" placeholder="Optional" maxlength="255" value="{{ old('description') }}" oninput="changeCount(event, 'excerpt_characters')" onfocus="changeCount(event, 'excerpt_characters')">
                            <datalist id="datalistOptions">
                                @if(isset($descriptions))
                                    @foreach ($descriptions as $description)
                                        <option value="{{ $description }}">{{ $description }}</option>
                                    @endforeach
                                @endif
                            </datalist>
                            <small id="excerpt_characters" class="form-text text-muted"></small>
                        </div>
                        <button type="submit" class="btn btn-primary">Create</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection