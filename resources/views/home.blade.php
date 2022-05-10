@extends("layouts.app")
@section("title", "Home")
@section("content")
<div class="container">
    <div class="row justify-content-center">
        @include("partials.popup")
        <div class="col-md-8">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <p class="m-0">{{ __("Dashboard") }}</p>
                    <span>
                        <a class="btn btn-primary" href="{{ route('questions.start', $quizLanguage->id) }}">
                            <p class="text-icon-inline card-text">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 d-inline d-sm-none" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" clip-rule="evenodd" />
                                </svg>
                                <span class="d-none d-sm-inline">
                                    Quick-fire lesson
                                </span>
                            </p>
                        </a>
                    </span>
                </div>
                <div class="card-body">

                </div>
            </div>
            <div class="card mt-4">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <p class="m-0">Your Languages</p>
                    <span>
                        <a class="btn btn-primary" href="{{ route('users.enrolLanguage', $user) }}">
                            <p class="text-icon-inline card-text">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 d-inline d-sm-none" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" clip-rule="evenodd" />
                                </svg>
                                <span class="d-none d-sm-inline">
                                    Choose New Language
                                </span>
                            </p>
                        </a>
                    </span>
                </div>
                <div class="card-body">
                    @if (isset($languages) && count($languages) > 0)
                        @foreach ($languages as $key => $language)
                            <div class="{{ $key != count($languages) - 1 ? 'mb-3' : '' }}">
                                <div class="card d-flex language-list-card">
                                    <div class="d-flex flex-row align-items-center language-list-card">
                                        <span class="card-img-top rounded language-logo d-none d-lg-block">{!! $language->flag_svg !!}</span>
                                        <div class="card-body language-details">
                                            <span class="badge badge-primary role-badge">{{ $language->code }}</span>
                                            <h4 class="card-title language-title language-title-large">{{ $language->name }} <span class="d-lg-none">{!! $language->flag_svg !!}</span></h4>
                                            <p class="card-text">{{ $language->excerpt }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @else
                        @include("partials.no-content", [
                            "title" => "No Languages Available",
                            "text" => "Oops! It looks like you haven't enrolled on any languages yet. Enrol on one for it to appear here!"
                        ])
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
