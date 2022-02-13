@extends('layouts.app')
@section('title', 'Role Manager')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        @include("partials.popup")
        <div class="col-md-9">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <p class="m-0">Roles</p>
                    @can('role-create')
                        <span>
                            <a class="btn btn-primary" href="{{ route('roles.create') }}">New Role</a>
                        </span>
                    @endcan
                </div>
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
                            @foreach ($data as $key => $role)
                                <tr class="align-middle">
                                    <td>{{ $role->id }}</td>
                                    <td>{{ $role->name }}</td>
                                    <td>
                                        <div class="d-flex">
                                            <a class="btn btn-primary" href="{{ route('roles.show',$role->id) }}">Show</a>
                                            @can('role-delete')
                                                {!! Form::open(['method' => 'DELETE','route' => ['roles.destroy', $role->id], 'class' => 'ms-2']) !!}
                                                {!! Form::submit('Delete', ['class' => 'btn btn-secondary']) !!}
                                                {!! Form::close() !!}
                                            @endcan
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{ $data->render() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection