@extends("layouts.app")
@section("title", "Permission Centre")
@section("content")
<div class="container">
    <div class="row justify-content-center">
        @include("partials.popup")
        <div class="col-md-9">
            <div class="card">
                @include("partials.card-header", [
                    "title" => "Permissions",
                    "primaryButton" => [
                        "condition" => "permission-create",
                        "url" => "permissions.create",
                        "text" => "New Permission",
                        "mobileIcon" => "atoms/icon.plus-symbol"
                    ],
                    "secondaryButton" => ["isDefault" => true]
                ])
                <div class="card-body">
                    @can("permission-list")
                        <div class="mb-3">
                            @for ($i = 0; $i < count($data); $i+=2)
                                <div class="row mb-0 {{ $i != count($data) - 2 ? 'mb-sm-4' : '' }}">
                                    <div class="col-sm-6 {{ $i == ($data->count() - 1) ? '' : 'mb-4 mb-sm-0' }}">
                                        @include("partials.card", [
                                            "title" => $data[$i]->name,
                                            "text" => $data[$i]->description,
                                            "link" => ["url" => "permissions.show", "data" => $data[$i]]
                                        ])
                                    </div>
                                    @if ($i + 1 < count($data))
                                        <div class="col-sm-6 {{ ($i + 1) == ($data->count() - 1) ? '' : 'mb-4 mb-sm-0' }}">
                                            @include("partials.card", [
                                                "title" => $data[$i + 1]->name,
                                                "text" => $data[$i + 1]->description,
                                                "link" => ["url" => "permissions.show", "data" => $data[$i + 1]]
                                            ])
                                        </div>
                                    @endif
                                </div>
                            @endfor
                        </div>
                        {{ $data->appends($_GET)->links() }}
                    @else
                        <p class="mb-0">You are not allowed to view permissions.</p>
                    @endcan
                </div>
            </div>
        </div>
    </div>
</div>
@endsection