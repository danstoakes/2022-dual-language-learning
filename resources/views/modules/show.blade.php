@extends('layouts.app')
@section('title', $module->name)
@section('content')
<div class="container">
    <div class="row justify-content-center">
        @include("partials.popup")
        <div class="col-md-9">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <p class="m-0">Module</p>
                    @can('language-list')
                        <span>
                            <a class="btn btn-primary" href="{{ route('modules.edit', $module->id) }}">Edit</a>
                        </span>
                    @endcan
                </div>
                <div class="card-body table-responsive">
                    <div class="d-flex flex-column mb-2">
                        <div>
                            <h4 class="card-title">{{ $module->name }}</h4>
                            <p class="card-text">{{ $module->description }}</p>
                        </div>
                    </div>
                    <table class="table table-hover">
                        <thead class="thead-dark">
                            <tr>
                                <th width="90%">Phrase</th>
                                <th width="10%">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($phrases as $key => $phrase)
                                <tr class="align-middle">
                                    <td>{{ $phrase->phrase }}</td>
                                    <td class="d-flex">
                                        <a class="btn btn-primary" href="{{ route('phrases.show', $phrase->id) }}">Show</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{ $phrases->appends($_GET)->links() }}
                </div>
                <div class="card-footer d-flex justify-content-end">
                    @can('language-list')
                        <span>
                            <a class="btn btn-primary" href="{{ route('modules.managePhrases', $module) }}">Manage Phrases</a>
                        </span>
                    @endcan
                </div>
            </div>
        </div>
    </div>
</div>
@endsection