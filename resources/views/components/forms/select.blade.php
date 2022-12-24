<div class="mb-3">
    <label for="{{$name}}" class="form-label">{{$label}}</label>
    <select id="{{$name}}"
            wire:model="{{$name}}"
            name="{{$name}}"
            {{ $required ? 'required' : ''}}
            class="form-control select2 @error($name) is-invalid @enderror" >
        <option value="{{null}}">--Select--</option>
        @foreach($options as $key => $option)
            @php($val = $option->id??$key)
            <option {!!  $val == $value ? 'selected' : ''!!}  value="{{$val}}">
                {{ $option->{$targetColumn} ?? $option }}
            </option>
        @endforeach
    </select>
</div>
