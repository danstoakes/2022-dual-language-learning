<div class="card flex flex-row align-items-center language-list-card phrase-list-card {{ (isset($batchCount) && $batchCount == $phrase->getBatchCount() - 1) || isset($lastCard) && $lastCard ? 'phrase-list-card-bottom' : '' }}">
    <span class="card-img-top rounded phrase-language-logo">{!! $phrase->getLogoSVG() !!}</span>
    <div class="card-body language-details d-flex justify-content-between">
        <p class="card-text mt-auto mb-auto mr-1">{{ $phrase->phrase }}</p>
        @php
            $modules = $phrase->modules();
        @endphp

        @if (isset($showRecordingButton) && $showRecordingButton)
            <div class="d-flex">
                <a class="btn btn-primary" href="{{ route('recordings.generate', $phrase) }}">{{ $phrase->recordings() ? 'Update' : 'Generate' }}</a>
                @can('recording-delete')
                    @if ($phrase->recordings())
                        <form method="POST" action="{{ route('recordings.destroy', $phrase->recordings()) }}" class="ms-2">
                            @csrf
                            @method('DELETE')
                            <input class="btn btn-outline-primary" type="submit" value="Delete" />
                        </form>
                    @endif
                @endcan
            </div>
        @else
            @if (isset($modules) && $modules->count() > 0)
                <small class="form-text text-muted mt-auto mb-auto d-none d-sm-inline text-icon-inline card-text text-nowrap">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    Used in {{ $modules->count() }} module{{ $modules->count() > 1 ? 's' : '' }}.
                </small>
            @else
                <small class="form-text text-muted mt-auto mb-auto d-none d-sm-inline text-icon-inline card-text text-nowrap">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                    </svg>
                    Not used in a module.
                </small>
            @endif
        @endif
    </div>
</div>