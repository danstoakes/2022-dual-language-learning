@extends('layouts.app')
@section('title', 'Admin Portal')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="row mb-4">
                @can('user-list')
                    <div class="col-sm-6">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">{{ __("User Hub") }}</h5>
                                <p class="card-text">{{ __("Create new users or manage existing ones.") }}</p>
                                <a href="{{ route('users.index') }}" class="btn btn-primary">{{ __("View") }}</a>
                            </div>
                        </div>
                    </div>
                @endcan
                @can('language-list')
                    <div class="col-sm-6">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">{{ __("Language Hub") }}</h5>
                                <p class="card-text">{{ __("Add new languages or manage existing ones.") }}</p>
                                <a href="{{ route('languages.index') }}" class="btn btn-primary">{{ __("View") }}</a>
                            </div>
                        </div>
                    </div>
                @endcan
            </div>
            <div class="row">
                @can('role-list')
                    <div class="col-sm-6">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">{{ __("Role Manager") }}</h5>
                                <p class="card-text">{{ __("Add, manage or delete existing user roles.") }}</p>
                                <a href="{{ route('roles.index') }}" class="btn btn-primary">{{ __("View") }}</a>
                            </div>
                        </div>
                    </div>
                @endcan
                @can('permission-list')
                    <div class="col-sm-6">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">{{ __("Permission Centre") }}</h5>
                                <p class="card-text">{{ __("Manage existing permissions or create new ones.") }}</p>
                                <a href="{{ route('permissions.index') }}" class="btn btn-primary">{{ __("View") }}</a>
                            </div>
                        </div>
                    </div>
                @endcan
            </div>
        </div>
    </div>
</div>
@endsection
