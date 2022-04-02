@extends("layouts.app")
@section("title", "Add to Module")
@section("content")
<div class="container">
    <div class="row justify-content-center">
        @include("partials.popup")
        <div class="col-md-9">
            <div class="card">
                @include("partials.card-header", [
                    "title" => "Phrases",
                    "primaryButton" => [
                        "condition" => "language-create",
                        "url" => "phrases.create",
                        "text" => "New Phrase",
                    ]
                ])
                @if (isset($data) && count($data) > 0)
                    <div class="card-body table-responsive">
                        <form>
                            @csrf
                            @method("PATCH")
                            <table class="table table-hover">
                                <thead class="thead-dark">
                                    <tr>
                                        <th width="10%"></th>
                                        <th width="80%">Phrase</th>
                                        <th width="10%">Batch No.</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data as $batch)
                                        <tr class="align-middle">
                                            <td>
                                                <input {{ \App\Models\Module::find($module)->hasBatch($batch->batch_id) ? "checked" : "" }} class="phrase-checkbox" type="checkbox" name="batch_id[]" value="{{ $batch->batch_id }}" />
                                            </td>
                                            <td class="batch-phrase-list">{!! $batch->phrase !!}</td>
                                            <td class="text-black-50">{{ $batch->batch_id }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </form>
                    </div>
                @else
                    @include("partials.no-content", [
                        "title" => "No Phrases Available",
                        "text" => "Oops! It looks like there aren't any phrases yet."
                    ])
                @endif
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {
        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": $("meta[name='csrf-token']").attr("content")
            }
        });
    
        $(".phrase-checkbox").on("change", function(e) {
            e.preventDefault();
    
            $.ajax({
                type: "POST",
                url: "{{ route('modules.updatePhrases', $module) }}",
                data: {batch: e.target.value, isChecked: e.target.checked},
                success: function (data) {
                    setInterval('location.reload()', 100); // to show success message
                },
                error: function (xhr, status, error) {
                    setInterval('location.reload()', 100); // to show error message

                    var errorMessage = xhr.status + " - " + xhr.statusText
                    console.log("ERROR: " + errorMessage);
                }
            });
        });
    });
</script>
@endsection