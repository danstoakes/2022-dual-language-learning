@if (isset($data) && count($data) > 0)
    <div class="card-body">
        <div class="row">
            @foreach($data as $key => $language)
                <div class="{{ $key != count($data) - 1 ? 'mb-3' : '' }}">
                    <a href="{{ route('languages.show', $language->id) }}" class="text-decoration-none text-black">
                        <div class="card flex flex-row align-items-center language-list-card">
                            <span class="card-img-top rounded language-logo d-none d-lg-block">{!! $language->flag_svg !!}</span>
                            <div class="card-body language-details">
                                <h4 class="card-title language-title language-title-large">{{ $language->name }} <span class="d-lg-none">{!! $language->flag_svg !!}</span></h4>
                                <p class="card-text">{{ $language->excerpt }}</p>
                            </div>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>
        {{ $data->appends($_GET)->links() }}
    </div>
@else
    <div class="card-body">
        <div>
            <h4 class="card-title">No Languages Available</h4>
            <p class="card-text">Oops! It looks like there aren't any languages yet.</p>
        </div>
    </div>
@endif