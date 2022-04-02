<div class="card-header d-flex justify-content-between align-items-center">
    <p class="m-0">{{ __($title) }}</p>
    @if(isset($primaryButton) && Gate::check($primaryButton["condition"]))
        <span>
            <a class="btn btn-primary" href="{{ route($primaryButton['url'], $primaryButton['data'] ?? '') }}">
                <p class="text-icon-inline card-text">
                    @if (isset($primaryButton["mobileIcon"]) && $primaryButton["mobileIcon"])
                        @include($primaryButton["mobileIcon"])
                    @endif 
                    <span @class([
                        "d-none d-sm-inline" => isset($primaryButton["mobileIcon"]) && $primaryButton["mobileIcon"]
                    ])>
                        {{ __($primaryButton["text"]) }}
                    </span>
                </p>
            </a>
        </span>
    @else
        @if(isset($secondaryButton))
            @if(isset($secondaryButton["isDefault"]) && $secondaryButton["isDefault"])
                <span>
                    <a class="btn btn-primary" href="{{ route('portal') }}">
                        {{ __("Back") }}
                    </a>
                </span>
            @else
                @can($secondaryButton["condition"])
                    <span>
                        <a class="btn btn-primary" href="{{ route($secondaryButton["url"]) }}">
                            {{ __($secondaryButton["text"]) }}
                        </a>
                    </span>
                @endcan
            @endif
        @endif
    @endif
</div>