@if (isset($data) && count($data) > 0)
    <div class="card-body">
        <div class="row mb-3">
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
    <div class="card-body">
        <div>
            <h4 class="card-title">No Phrases Available</h4>
            <p class="card-text">Oops! It looks like there aren't any phrases yet.</p>
        </div>
    </div>
@endif