@extends("layouts.app")
@section("title", "Home")
@section("content")
<div class="container">
    <div class="row justify-content-center">
        @include("partials.popup")
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    {{ __("Dashboard") }}
                </div>
                <div class="card-body">
                    <p>Options here for quick challenge, i.e. just chuck random phrases into a challenge and GOOOO</p>
                    <p>Being able to see phrases completed overall, modules, etc.</p>
                    <p>Options for user statistics. i.e., lessons completed, questions completed, etc.</p>
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
                                    <div>
                                        <p class="card-text mx-2 mt-2">Modules completed</p>
                                        <p class="card-text mx-2 mt-2">Phrases completed</p>
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
            {{--<div class="card mt-4">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <p class="m-0">Your Languages</p>
                    @can('language-create')
                        <span>
                            <a class="btn btn-primary" href="{{ route('languages.add') }}">
                                <p class="text-icon-inline card-text">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 d-inline d-sm-none" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" clip-rule="evenodd" />
                                    </svg>
                                    <span class="d-none d-sm-inline">
                                        New Language
                                    </span>
                                </p>
                            </a>
                        </span>
                    @endcan
                </div>
                @if (isset($languages) && count($languages) > 0)
                    <div class="card-body">
                        @foreach ($languages as $key => $language)
                            <div class="{{ $key != count($languages) - 1 ? 'mb-3' : '' }}">
                                <a href="{{ route('languages.manage', [$language->id, $language->variant_id]) }}" class="text-decoration-none text-black">
                                    <div class="card flex flex-row align-items-center language-list-card">
                                        <span class="card-img-top rounded language-logo d-none d-lg-block">{!! $language->flag_svg !!}</span>
                                        <div class="card-body language-details">
                                            <span class="badge badge-primary role-badge">{{ $language->code }}</span>
                                            <h4 class="card-title language-title language-title-large">{{ $language->name }} <span class="d-lg-none">{!! $language->flag_svg !!}</span></h4>
                                            <p class="card-text">{{ $language->excerpt }}</p>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="card-body">
                        <div>
                            <h4 class="card-title">No Languages Yet</h4>
                            <p class="card-text">It looks like you haven't set-up a language yet.</p>
                        </div>
                    </div>
                @endif
            </div> --}}
        </div>
    </div>
</div>
@endsection
