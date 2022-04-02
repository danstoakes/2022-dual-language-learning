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
                    @include("atoms/icon.tick-symbol")
                    Used in {{ $modules->count() }} module{{ $modules->count() > 1 ? 's' : '' }}.
                </small>
            @else
                <small class="form-text text-muted mt-auto mb-auto d-none d-sm-inline text-icon-inline card-text text-nowrap">
                    @include("atoms/icon.caution-symbol")
                    {{ __("Not used in a module.") }}
                </small>
            @endif
        @endif
    </div>
</div>