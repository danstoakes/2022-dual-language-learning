@extends("layouts.app")
@section("title", __("Language Hub"))
@section("content")
    <div class="container">
        <div class="row justify-content-center">
            @include("partials.popup")
            <div class="col-md-9">
                <div class="card">
                    @include("partials.card-header", [
                        "title" => "Languages",
                        "secondaryButton" => [
                            "isDefault" => true
                        ]
                    ])
                    @include("languages.list")
                </div>
            </div>
        </div>
    </div>
@endsection