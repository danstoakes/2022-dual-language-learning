@extends('layouts.app')
@section('title', 'New User')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        @include("partials.popup")
        <div class="col-md-9">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <p class="m-0">Users</p>
                    @can('user-create')
                        <span>
                            <a class="btn btn-primary" href="{{ route('users.create') }}">New User</a>
                        </span>
                    @endcan
                </div>
                <div class="card-body table-responsive">
                    <table class="table table-hover">
                        <thead class="thead-dark">
                            <tr>
                                <th width="10%">#</th>
                                <th width="15%">Name</th>
                                <th width="32%">Email</th>
                                <th width="13%">Role</th>
                                <th width="20%">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $key => $user)
                                <tr class="align-middle">
                                    <td>{{ $user->id }}</td>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>
                                        @if(!empty($user->getRoleNames()))
                                            @foreach($user->getRoleNames() as $val)
                                                {{ ucfirst($val) }}
                                            @endforeach
                                        @endif
                                    </td>
                                    <td>
                                        <div class="d-flex">
                                            <a class="btn btn-primary" href="{{ route('users.show', $user->id) }}">Show</a>
                                            @can('user-delete')
                                                {!! Form::open(['method' => 'DELETE','route' => ['users.destroy', $user->id], 'class' => 'ms-2']) !!}
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