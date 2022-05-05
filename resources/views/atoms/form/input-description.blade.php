<div @class([
    "form-group",
    "mb-2" => $hasBottomMargin
])>
    <label for="description">{{ __("Description") }}</label>
    <textarea 
        id="language_select_description" 
        class="form-control" 
        name="description" 
        rows="4" 
        maxlength="{{ $maxLength }}" 
        oninput="changeCount(event, 'description_characters')" 
        onfocus="changeCount(event, 'description_characters')"         
        {{ isset($isRequired) && $isRequired ? "required" : "" }}
        {{ isset($isDisabled) && $isDisabled ? "disabled" : "" }}
    >{{ old("description", $data ?? "") }}</textarea>
    <small id="description_characters" class="form-text text-muted"></small>
</div>