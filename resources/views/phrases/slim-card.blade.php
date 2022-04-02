<div class="col-sm-6 {{ $lastCard ? '' : 'mb-4 mb-sm-0' }}">
    <div class="card flex align-items-top language-list-card h-100">
        <div class="card-body language-details">
            <p class="card-text language-title">{{ $phrase->phrase }} {!! $phrase->getLanguageFlag() !!}</p>
            <div class="form-group mt-3 d-flex">
                @php
                    $voices = $phraseVoices[$phrase->id]["voices"];
                @endphp
                <form method="POST" action="{{ route('recordings.generate', $phrase) }}">
                    @csrf
                    <div class="form-group d-flex align-items-center justify-content-between">
                        <div class="language-dropdown-section flex-grow-1">
                            <select name="language_voice" class="form-select" aria-label="Default select example">
                                @foreach ($voices as $key => $voice)
                                    <option 
                                        value="{{ $voice['id'] }}"
                                        {{ old('language_voice') == $voice['id'] ? 'selected' : '' }}
                                    >{{ $voice['display_name'] }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="language-variety-dropdown-section flex-grow-0">
                            <button type="submit" class="btn btn-primary">Generate</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        @can("recording-delete")
            @if ($phrase->hasRecordings())
                <div class="card-footer" id="heading-{{ $phrase->id }}">
                    <h5 class="mb-0">
                        <button class="btn btn-link text-decoration-none" data-toggle="collapse" data-target="#collapse-{{ $phrase->id }}" aria-expanded="false" aria-controls="collapse-{{ $phrase->id }}">
                            Manage Recordings
                        </button>
                    </h5>
                </div>
                <div id="collapse-{{ $phrase->id }}" class="collapse" aria-labelledby="heading-{{ $phrase->id }}">
                    <div class="card-body">
                        @foreach ($phrase->recordings() as $key => $recording)
                            <div class="form-group d-flex justify-content-between align-items-center {{ $key != count($phrase->recordings()) - 1 ? 'mb-4' : '' }}">
                                <div>
                                    <span>{{ $recording->file_name }}</span>
                                </div>
                                <div>
                                    <form method="POST" action="{{ route('recordings.destroy', $recording) }}" class="ms-2">
                                        @csrf
                                        @method('DELETE')
                                        <input class="btn btn-outline-primary" type="submit" value="Delete" />
                                    </form>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif
        @endcan
    </div>
</div>