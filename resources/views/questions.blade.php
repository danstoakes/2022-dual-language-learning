@extends("layouts.app")
@section("title", "Questions")
@section("content")
<div class="container">
    <div class="row justify-content-center">
        @if (isset($questions) && $questions !== null && count($questions) > 0)
            @foreach ($questions as $question)
                <p>{{ $question["question"] }}</p>
            @endforeach
        @endif
    </div>
</div>
@endsection