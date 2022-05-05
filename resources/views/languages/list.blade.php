@if (isset($languages) && count($languages) > 0)
    <div class="card-body">
        <div class="row">
            @foreach($languages as $key => $language)
                <div @class([
                    "mb-3" => !$loop->last
                ])>
                    <a href="{{ route("languages.show", $language) }}" class="text-decoration-none text-black">
                        <div class="card flex flex-row align-items-center language-list-card">
                            <span class="card-img-top rounded language-logo d-none d-lg-block">{!! $language->flag_svg !!}</span>
                            <div class="card-body language-details">
                                <h4 class="card-title language-title language-title-large">{{ __($language->name) }} <span class="d-lg-none">{!! $language->flag_svg !!}</span></h4>
                                <p class="card-text">{{ __($language->excerpt) }}</p>
                            </div>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>
        {{ $languages->appends($_GET)->links() }}
    </div>
@else
    @include("partials.no-content", [
        "title" => "No Languages Available",
        "text" => "Oops! It looks like there aren't any languages yet."
    ])
@endif