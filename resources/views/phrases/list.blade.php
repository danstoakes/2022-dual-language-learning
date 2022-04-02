@if (isset($data) && count($data) > 0)
    <div class="card-body">
        <div class="row {{ $data->appends($_GET)->links() == null ? 'mb-3' : '' }}">
            @foreach($data as $key => $phrase)
                @php
                    if (!isset($batchCount) || isset($batchId) && $batchId != $phrase->batch_id)
                        $batchCount = 0;
                @endphp
                <div class="{{ isset($batchId) && $batchId != $phrase->batch_id ? 'mt-4' : '' }}">
                    @if (isset($showRecordingButton) && $showRecordingButton)
                        {{-- Separated to prevent issues with nested anchor tags --}}
                        @include('phrases.card')
                    @else
                        <a href="{{ route('phrases.show', $phrase->id) }}" class="text-decoration-none text-black">
                            @include('phrases.card')
                        </a>
                    @endif
                </div>
                @php
                    $batchId = $phrase->batch_id;
                    $batchCount++;
                @endphp
            @endforeach
        </div>
        {{ $data->appends($_GET)->links() }}
    </div>
@else
    @include("partials.no-content", [
        "title" => "No Phrases Available",
        "text" => "Oops! It looks like there aren't any phrases yet."
    ])
@endif