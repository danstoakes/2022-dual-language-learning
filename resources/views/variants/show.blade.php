@extends('layouts.app')
@section('title', $variant->code)
@section('content')
<div class="container">
    <div class="row justify-content-center">
        @include("partials.popup")
        <div class="col-md-9">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <p class="m-0">User</p>
                    @can('user-list')
                        <span>
                            <a class="btn btn-primary" href="{{ route('languages.index') }}">Back</a>
                        </span>
                    @endcan
                </div>
                <div class="card-body">
                    <div class="d-flex flex-column">
                        <h4 class="card-title language-title language-title-large {{ $user->email ? '' : 'mb-0' }}">
                            {{ $user->name }}
                            <a href="{{ route('users.edit', $user) }}">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20">
                                    <path d="M17.414 2.586a2 2 0 00-2.828 0L7 10.172V13h2.828l7.586-7.586a2 2 0 000-2.828z" />
                                    <path fill-rule="evenodd" d="M2 6a2 2 0 012-2h4a1 1 0 010 2H4v10h10v-4a1 1 0 112 0v4a2 2 0 01-2 2H4a2 2 0 01-2-2V6z" clip-rule="evenodd" />
                                </svg>
                            </a>
                        </h4>
                        <p class="card-text">{{ $user->email }}</p>
                    </div>
                </div>
            </div>
            <div class="d-flex justify-content-end">
                <small class="form-text text-muted">Last updated {{ $user->updated_at->diffForHumans() }}</small>
            </div>
        </div>
    </div>
</div>
@endsection