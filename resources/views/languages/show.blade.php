@extends('layouts.app')
@section('title', $language->name)
@section('content')
<div class="container">
    <div class="row justify-content-center">
        @include("partials.popup")
        <div class="col-md-9">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <p class="m-0">Language</p>
                    @can('language-edit')
                        <span>
                            <a class="btn btn-primary" href="{{ route('languages.edit', $language->id) }}">Edit</a>
                        </span>
                    @else
                        @can('language-list')
                            <span>
                                <a class="btn btn-primary" href="{{ route('languages.index') }}">Back</a>
                            </span>
                        @endcan
                    @endcan
                </div>
                <div class="card-body">
                    <div class="d-flex flex-column">
                        <div>
                            <h4 class="card-title language-title language-title-large">{{ $language->name }} {!! $language->logo_path !!}</h4>
                            <p class="card-text">{{ $language->description }}</p>
                        </div>
                        <div class="mt-3">
                            <h5 class="card-title">Modules ({{ count($modules) }})</h5>
                            @if (count($modules) > 0)
                                @foreach ($modules as $module)
                                    <a href="{{ route('modules.show', $module['id']) }}">{{ $module["name"] }}</a>                            
                                @endforeach
                            @else
                                <p class="text-icon-inline card-text">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                                    </svg>
                                    There are no modules to display.
                                </p>
                            @endif
                        </div>
                    </div>
                </div>
                @can('module-create', 'language-delete')
                    <div class="card-footer d-flex justify-content-between">
                        @can('module-create')
                            <span>
                                <a class="btn btn-primary" href="{{ route('modules.create', $language->id) }}">Create Module</a>
                            </span>
                            <span>
                                @can('language-delete')
                                    {!! Form::open(['method' => 'DELETE','route' => ['languages.destroy', $language->id], 'class' => 'ms-2']) !!}
                                    {!! Form::submit('Delete', ['class' => 'btn btn-secondary']) !!}
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