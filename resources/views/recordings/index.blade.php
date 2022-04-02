@extends("layouts.app")
@section("title", "Recording Hub")
@section("content")
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card mb-3">
                    @include("partials.card-header", [
                        "title" => "Recordings",
                        "primaryButton" => [
                            "condition" => "recording-create",
                            "url" => "recordings.create",
                            "text" => "Manage",
                        ],
                        "secondaryButton" => ["isDefault" => true]
                    ])
                    @include("recordings.list")
                </div>
            </div>
        </div>
    </div>
@endsection