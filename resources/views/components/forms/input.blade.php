<div class="mb-3">
    <label for="{{$name}}" class="form-label">{{$label}}</label>
    <input type="{{$type}}"
           wire:model="{{$name}}"
           name="{{$name}}"
           id="{{$name}}"
           placeholder="{{$placeholder}}"
           {{ $required ? 'required' : ''}}
           value="{{$value}}"
           class="form-control @error($name) is-invalid @enderror">
    @if(!is_array($name))
        @error($name)
        <div class="invalid-feedback">
            {{$message}}
        </div>
        @enderror
    @endif
</div>
