@extends("layouts.app")
@section("title", $module->name)
@section("content")
<div class="container">
    <div class="row justify-content-center">
        @include("partials.popup")
        <div class="col-md-9">
            <div class="card">
                @include("partials.card-header", [
                    "title" => "Module",
                    "primaryButton" => [
                        "condition" => "module-edit",
                        "url" => "modules.edit",
                        "data" => $module,
                        "text" => "Edit",
                        "mobileIcon" => "atoms/icon.edit-button-symbol"
                    ],
                    "secondaryButton" => [
                        "condition" => "module-list",
                        "url" => "modules.index",
                        "text" => "Back"
                    ]
                ])
                <div class="card-body table-responsive">
                    <div class="d-flex flex-column mb-2">
                        <div>
                            <h4 class="card-title">{{ $module->name }}</h4>
                            <p class="card-text">{{ $module->description }}</p>
                        </div>
                    </div>
                    <div class="{{ count($phrases) > 0 ? 'mt-2' : '' }}">
                        <h5 class="card-title">Phrases ({{ count($phrases) }})</h5>
                        @if (isset($phrases) && count($phrases) > 0)
                            @foreach ($phrases as $key => $phrase)
                                <a href="{{ route('phrases.show', $phrase->id) }}" class="text-decoration-none text-black">
                                    @php
                                        $lastCard = $key == count($phrases) - 1;
                                    @endphp
                                    @include("phrases.card")
                                </a>
                            @endforeach
                        @else
                            <p class="text-icon-inline card-text">
                                @include("atoms/icon.caution-symbol")
                                There are no phrases to display.
                            </p>
                        @endif
                    </div>
                    {{ $phrases->appends($_GET)->links() }}
                </div>
                @if(Gate::check("phrase-manage") || Gate::check("phrase-delete"))
                    <div class="card-footer d-flex justify-content-between">
                        @can("phrase-manage")
                            <span>
                                <a class="btn btn-primary" href="{{ route('modules.managePhrases', $module) }}">Manage Phrases</a>
                            </span>
                        @endcan
                        <span>
                            @can("phrase-delete")
                                {!! Form::open(['method' => 'DELETE','route' => ['modules.destroy', $module->id], 'class' => 'ms-2']) !!}
                                {!! Form::submit('Delete', ['class' => 'btn btn-outline-primary']) !!}
                                {!! Form::close() !!}
                            @endcan
                        </span>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection