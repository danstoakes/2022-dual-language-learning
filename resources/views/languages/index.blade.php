@extends('layouts.app')
@section('content')
<div class="container">
    <div class="justify-content-center">
        @if (\Session::has('success'))
            <div class="alert alert-success">
                <p>{{ \Session::get('success') }}</p>
            </div>
        @endif
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <p class="m-0">Languages</p>
                @can('language-create')
                    <span>
                        <a class="btn btn-primary" href="{{ route('languages.create') }}">New Language</a>
                    </span>
                @endcan
            </div>
            <div class="card-body d-flex">
                <div class="grid grid-cols-1 dashboard-grid pointer language-cards">
                    @foreach($data as $key => $language)
                        <a href="">
                            @if($loop->last)
                                <div class="grid grid-cols-12 bg-gray-100 overflow-hidden shadow rounded-lg dashboard-card language-card p-3 rounded">
                                    <h2 class="col-span-10 text-lg font-bold">{{ $language->name }}<span>{!! $language->logo_path !!}</span></h2>
                                    <div class="col-span-10 text-sm pr-20">{{ $language->description }}</div>
                                </div>
                            @else
                                <div class="grid grid-cols-12 mb-3 bg-gray-100 overflow-hidden shadow rounded-lg dashboard-card language-card p-3 rounded">
                                    <h2 class="col-span-10 text-lg font-bold">{{ $language->name }}<span>{!! $language->logo_path !!}</span></h2>
                                    <div class="col-span-10 text-sm pr-20">{{ $language->description }}</div>
                                </div>
                            @endif
                        </a>
                    @endforeach
                </div>
                {{ $data->render() }}
            </div>
        </div>
    </div>
</div>
@endsection