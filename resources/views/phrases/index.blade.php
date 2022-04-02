@extends("layouts.app")
@section("title", "Phrase Hub")
@section("content")
<div class="container">
    <div class="row justify-content-center">
        @include("partials.popup")
        <div class="col-md-9">
            <div class="card">
                @include("partials.card-header", [
                    "title" => "Phrases",
                    "primaryButton" => [
                        "condition" => "phrase-create",
                        "url" => "phrases.create",
                        "text" => "New Phrase",
                        "mobileIcon" => "atoms/icon.plus-symbol"
                    ],
                    "secondaryButton" => ["isDefault" => true]
                ])
                @include("phrases.list", [
                    "showRecordingButton" => false
                ])
            </div>
        </div>
    </div>
</div>
@endsection