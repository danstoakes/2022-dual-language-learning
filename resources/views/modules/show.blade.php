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
                    <div class="mb-2">
                        <span>
                            <a class="btn btn-primary" href="{{ route('phrases.create') }}">Add Phrase</a>
                        </span>
                    </div>
                    <table class="table table-hover">
                        <thead class="thead-dark">
                            <tr>
                                <th width="10%">#</th>
                                <th width="70%">Name</th>
                                <th width="20%">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($phrases as $key => $phrase)
                                <tr class="align-middle">
                                    <td>{{ $phrase->id }}</td>
                                    <td>{{ $phrase->name }}</td>
                                    <td class="d-flex">
                                        <a class="btn btn-primary" href="{{ route('phrases.show', $$phrase->id) }}">Show</a>
                                        @can('language-delete')
                                            {!! Form::open(['method' => 'DELETE','route' => ['phrases.destroy', $phrase->id], 'class' => 'ms-2']) !!}
                                            {!! Form::submit('Delete', ['class' => 'btn btn-secondary']) !!}
                                            {!! Form::close() !!}
                                        @endcan
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{ $phrases->appends($_GET)->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection