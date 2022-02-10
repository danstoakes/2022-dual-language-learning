<!--
    List all phrases, with them being grouped by their batch_id.

    How much does it cost?
    Wie viel kostet es?
    Hur mycket kostet det?

    Where are you from?
    Woher kommen Sie?
    Var kommer du ifrån?

    Could feature a little flag for the country of origin of each phrase.
-->

@extends('layouts.app')
@section('title', 'Phrase Hub')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        @include("partials.popup")
        <div class="col-md-9">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <p class="m-0">Phrases</p>
                    @can('language-create')
                        <span>
                            <a class="btn btn-primary" href="{{ route('phrases.create') }}">New Phrase</a>
                        </span>
                    @endcan
                </div>
                @if (isset($data) && count($data) > 0)
                    <div class="card-body table-responsive">
                        <table class="table table-hover">
                            <thead class="thead-dark">
                                <tr>
                                    <th width="10%">#</th>
                                    <th width="70%">Name</th>
                                    <th width="20%">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data as $key => $permission)
                                    <tr class="align-middle">
                                        <td>{{ $permission->id }}</td>
                                        <td>{{ $permission->phrase }}</td>
                                        <td class="d-flex">
                                            <a class="btn btn-primary" href="{{ route('permissions.show', $permission->id) }}">Show</a>
                                            @can('role-delete')
                                                {!! Form::open(['method' => 'DELETE','route' => ['permissions.destroy', $permission->id], 'class' => 'ms-2']) !!}
                                                {!! Form::submit('Delete', ['class' => 'btn btn-secondary']) !!}
                                                {!! Form::close() !!}
                                            @endcan
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{ $data->appends($_GET)->links() }}
                    </div>
                @else
                    <div class="card-body">
                        <div>
                            <h4 class="card-title">No Phrases Available</h4>
                            <p class="card-text">Oops! It looks like there aren't any phrases yet.</p>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection