<div @class([
    "form-group",
    "mb-2" => $hasBottomMargin
])>
    <label for="name">Name</label>
    <input 
        class="form-control" 
        type="text" 
        name="name" 
        value="{{ old("name", $data ?? "") }}" 
        {{ isset($isRequired) && $isRequired ? "required" : "" }}
        {{ isset($isDisabled) && $isDisabled ? "disabled" : "" }}
    />
</div>