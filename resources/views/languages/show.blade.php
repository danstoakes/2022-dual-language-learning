@extends("layouts.app")
@section("title", __($language->name))
@section("content")
    <div class="container">
        <div class="row justify-content-center">
            @include("partials.popup")
            <div class="col-md-9">
                <div class="card">
                    @include("partials.card-header", [
                        "title" => "Language",
                        "primaryButton" => [
                            "condition" => "language-edit",
                            "url" => "languages.edit",
                            "data" => $language,
                            "text" => "Edit",
                            "mobileIcon" => "atoms/icon.edit-button-symbol"
                        ],
                        "secondaryButton" => [
                            "condition" => "language-list",
                            "url" => "languages.index",
                            "text" => "Back"
                        ]
                    ])
                    <div class="card-body">
                        <div class="d-flex flex-column">
                            <div>
                                <h4 class="card-title language-title language-title-large">{{ __($language->name) }} {!! $language->flag_svg !!}</h4>
                                <p class="card-text">{{ __($language->description) }}</p>
                            </div>
                            <div class="mt-3">
                                <h5 class="card-title">{{ "Variants " . "(" . count($variants) . ")" }}</h5>
                                @if (count($variants) > 0)
                                    <div class="lead">
                                        @foreach($variants as $variant)
                                            <label class="badge badge-success btn-primary">
                                                {{ __($variant) }}
                                            </label>
                                        @endforeach
                                    </div>
                                @else
                                    <p class="text-icon-inline card-text">
                                        @include("atoms/icon.caution-symbol")
                                        {{ __("There are no variants to display.") }}
                                    </p>
                                @endif
                            </div>
                            <div class="mt-3">
                                <h5 class="card-title">{{ "Modules " . "(" . count($modules) . ")" }}</h5>
                                @if (count($modules) > 0)
                                    @foreach ($modules as $module)
                                        <a href="{{ route('modules.show', $module['id']) }}">{{ __($module["name"]) }}</a>                            
                                    @endforeach
                                @else
                                    <p class="text-icon-inline card-text">
                                        @include("atoms/icon.caution-symbol")
                                        {{ __("There are no modules to display.") }}
                                    </p>
                                @endif
                            </div>
                        </div>
                    </div>
                    @can("module-create", "language-delete")
                        <div class="card-footer d-flex justify-content-between">
                            @can("module-create")
                                <span>
                                    <a class="btn btn-primary" href="{{ route('modules.create', $language->id) }}">{{ __("Create Module") }}</a>
                                </span>
                                <span>
                                    @can("language-delete")
                                        {!! Form::open(['method' => 'DELETE','route' => ['languages.destroy', $language->id], 'class' => 'ms-2']) !!}
                                        {!! Form::submit('Delete', ['class' => 'btn btn-outline-primary']) !!}
                                        {!! Form::close() !!}
                                    @endcan
                                </span>
                            @endcan
                        </div>
                    @endcan
                </div>
            </div>
        </div>
    </div>
@endsection