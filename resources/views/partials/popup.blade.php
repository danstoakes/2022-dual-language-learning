@if (\Session::has("success"))
    <div class="alert alert-success d-flex justify-content-between">
        <p>{{ \Session::get("success") }}</p>
        <span class="alert-close" id="alert_popup_close">&times;</span>
    </div>
@else
    @if ($errors != null && count($errors) > 0)
        <div class="alert alert-danger  d-flex justify-content-between">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
            <span class="alert-close" id="alert_popup_close">&times;</span>
        </div>
    @endif
@endif