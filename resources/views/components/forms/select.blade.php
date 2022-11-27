<div class="mb-3">
    <label for="{{$name}}" class="form-label">{{$label}}</label>
    <select id="{{$name.'34'}}"
            name="{{$name}}"
            {{ $required ? 'required' : ''}}
            class="form-select  @error($name) is-invalid @enderror">
        @foreach($options as $key => $option)
            <option selected value="{{$key}}">{{$option}}</option>
        @endforeach
    </select>
</div>
