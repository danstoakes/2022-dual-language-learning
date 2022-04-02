@extends("layouts.app")
@section("title", "Phrase Hub")
@section("content")
    <div class="container">
        <div class="row justify-content-center">
            @include("partials.popup")
            <div class="col-md-8">
                <div class="card">
                    @include("partials.card-header", [
                        "title" => "Phrases",
                        "primaryButton" => [
                            "condition" => "language-list",
                            "url" => "recordings.index",
                            "text" => "Back"
                        ]
                    ])
                    @include("phrases.grid")
                </div>
            </div>
        </div>
    </div>
@endsection