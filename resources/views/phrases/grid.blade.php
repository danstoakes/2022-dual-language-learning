<div class="card-body">
    <div class="{{ $data->appends($_GET)->links() == null ? 'mb-3' : '' }}">
        @for ($i = 0; $i < count($data); $i+=2)
            <div class="row mb-0 {{ $i != count($data) - 1 ? 'mb-sm-4' : '' }}">
                @include("phrases.slim-card", [
                    "phrase" => $data[$i],
                    "lastCard" => $i == ($data->count() - 1)
                ])
                @if ($i + 1 < count($data))
                    @include("phrases.slim-card", [
                        "phrase" => $data[$i + 1],
                        "lastCard" => ($i + 1) == ($data->count() - 1)
                    ])
                @endif
            </div>
        @endfor
    </div>
    {{ $data->appends($_GET)->links() }}
</div>