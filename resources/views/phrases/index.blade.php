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
                                    <th width="8%"></th>
                                    <th width="72%">Phrase</th>
                                    <th width="20%">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data as $key => $phrase)
                                    @if (isset($batchId) && $batchId != $phrase->batch_id)
                                        <tr class="align-middle">
                                            <td class="invisible">-</td>
                                            <td class="invisible"></td>
                                            <td class="invisible"></td>
                                        </tr>
                                    @elseif (!isset($batchId))
                                        <tr class="align-middle">
                                            <td class="invisible"></td>
                                            <td class="invisible"></td>
                                            <td class="invisible"></td>
                                        </tr>
                                    @endif
                                    <tr class="align-middle">
                                        <td>{!! $phrase->getLogoSVG() !!}</td>
                                        <td>{{ $phrase->phrase }}</td>
                                        <td>
                                            <div class="d-flex">
                                                <a class="btn btn-primary" href="{{ route('phrases.show', $phrase) }}">Show</a>
                                                @can('role-delete')
                                                    <form method="POST" action="{{ route('phrases.destroy', $phrase) }}" class="ms-2">
                                                        @csrf
                                                        @method('DELETE')
                                                        <input class="btn btn-secondary" type="submit" value="Delete" />
                                                    </form>
                                                @endcan
                                            </div>
                                        </td>
                                    </tr>
                                    @php
                                        $batchId = $phrase->batch_id;
                                    @endphp
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