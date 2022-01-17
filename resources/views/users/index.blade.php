@extends('layouts.app')
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
                                <th>#</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Role</th>
                                <th width="280px">Action</th>
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
                                        <a class="btn btn-success" href="{{ route('users.show',$user->id) }}">Show</a>
                                        @can('user-edit')
                                            <a class="btn btn-primary" href="{{ route('users.edit',$user->id) }}">Edit</a>
                                        @endcan
                                        @can('user-delete')
                                            {!! Form::open(['method' => 'DELETE','route' => ['users.destroy', $user->id],'style'=>'display:inline']) !!}
                                            {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
                                            {!! Form::close() !!}
                                        @endcan
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