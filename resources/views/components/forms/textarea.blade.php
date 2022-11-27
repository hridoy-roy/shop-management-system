<div class="mb-3">
    <label for="{{$name}}" class="form-label">{{$label}}</label>
    <div>
        <textarea
            type="{{$type}}"
            name="{{$name}}"
            id="{{$name}}"
            placeholder="{{$placeholder}}"
            {{ $required ? 'required' : ''}}
            class="form-control @error($name) is-invalid @enderror"
            rows="3">{{$value}}</textarea>
    </div>
    @if(!is_array($name))
        @error($name)
        <div class="invalid-feedback">
            {{$message}}
        </div>
        @enderror
    @endif
</div>
