@extends("layouts.app")
@section("title", "Create Module")
@section("content")
<div class="container">
    <div class="row justify-content-center">
        @include("partials.popup")
        <div class="col-md-9">
            <div class="card">
                @include("partials.card-header", [
                    "title" => "Create Module",
                    "primaryButton" => [
                        "condition" => "language-list",
                        "url" => "languages.show",
                        "data" => $language,
                        "text" => "Back",
                    ]
                ])
                <div class="card-body">
                    <form method="POST" action="{{ route('modules.store') }}">
                        @csrf
                        <input class="form-control" type="hidden" name="language_id" value="{{ $language }}" required />
                        @include("atoms/form.input-name", [
                            "hasBottomMargin" => true, "isRequired" => true
                        ])
                        @include("atoms/form.input-description", [
                            "hasBottomMargin" => true, "isRequired" => true, "maxLength" => "1024"
                        ])
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