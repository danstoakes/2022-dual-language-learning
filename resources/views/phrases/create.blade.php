@extends('layouts.app')
@section('title', 'Add Phrase')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        @include("partials.popup")
        <div class="col-md-9">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <p class="m-0">Add Phrase</p>
                    @can('language-list')
                        <span>
                            <a class="btn btn-primary" href="{{ url()->previous() }}">Back</a>
                        </span>
                    @endcan
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('phrases.store') }}">
                        <div class="form-group mb-2">
                            <strong>Phrase</strong>
                            <input class="form-control" name="phrase" type="text" required />
                        </div>
                        <div class="form-group mb-2 d-flex">
                            <input style="margin-right: 0.5em" class="mt-auto mb-auto form-check-input" name="partner_phrase" type="checkbox" id="phrase_create_checkbox" />
                            <label for="partner_phrase form-check-label">This phrase already exists</label>
                        </div>
                        <div style="display: none" id="select_similar_section">
                            <p>Here should be a dropdown of existing phrases, with their batch_id being the value</p>
                            <p>Would be nice if phrases could be grouped into a single entry by batch id or something</p>
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection