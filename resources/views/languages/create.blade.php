@extends('layouts.app')
@section('content')
<div class="container">
    <div class="justify-content-center">
        @include("partials.popup")
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <p class="m-0">Create Language</p>
                @can('language-list')
                    <span>
                        <a class="btn btn-primary" href="{{ route('languages.index') }}">Back</a>
                    </span>
                @endcan
            </div>
            <div class="card-body">
                {!! Form::open(array('route' => 'languages.store','method'=>'POST')) !!}
                    <div class="form-group">
                        <strong>Name:</strong>
                        {!! Form::text('name', null, array('placeholder' => 'Name','class' => 'form-control')) !!}
                    </div>
                    <div class="form-group">
                        <strong>Description:</strong>
                        {!! Form::text('description', null, array('placeholder' => 'Description','class' => 'form-control')) !!}
                    </div>
                    <div class="form-group">
                        <strong>Module count:</strong>
                        {!! Form::text('module_count', null, array('placeholder' => 'Module count','class' => 'form-control')) !!}
                    </div>
                    <div class="form-group">
                        <strong>Logo path:</strong>
                        {!! Form::text('logo_path', null, array('placeholder' => 'Logo path','class' => 'form-control')) !!}
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>
@endsection