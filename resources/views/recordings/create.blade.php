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
                    @can('language-list')
                        <span>
                            <a class="btn btn-primary" href="{{ route('recordings.index') }}">Back</a>
                        </span>
                    @endcan
                </div>
                @if (isset($data) && count($data) > 0)
                    <div class="card-body table-responsive">
                        <table class="table table-hover">
                            <thead class="thead-dark">
                                <tr>
                                    <th width="8%"></th>
                                    <th width="67%">Phrase</th>
                                    <th width="25%">Action</th>
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
                                                <a class="btn btn-primary" href="{{ route('recordings.generate', $phrase) }}">{{ $phrase->recording() ? 'Re-generate' : 'Generate' }}</a>
                                                @can('recording-delete')
                                                    @if ($phrase->recording())
                                                        <form method="POST" action="{{ route('recordings.destroy', $phrase->recording()) }}" class="ms-2">
                                                            @csrf
                                                            @method('DELETE')
                                                            <input class="btn btn-outline-primary" type="submit" value="Delete" />
                                                        </form>
                                                    @endif
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