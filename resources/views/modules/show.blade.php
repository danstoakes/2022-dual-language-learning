@extends("layouts.app")
@section("title", $module->name)
@section("content")
<div class="container">
    <div class="row justify-content-center">
        @include("partials.popup")
        <div class="col-md-9">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <p class="m-0">Module</p>
                    @can("module-edit")
                        <span>
                            <a class="btn btn-primary" href="{{ route('modules.edit', $module->id) }}">Edit</a>
                        </span>
                    @else
                        @can("module-list")
                            <span>
                                <a class="btn btn-primary" href="{{ route('modules.index') }}">Back</a>
                            </span>
                        @endcan
                    @endcan
                </div>
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
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                                </svg>
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