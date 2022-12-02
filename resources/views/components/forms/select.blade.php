<div class="mb-3">
    <label for="{{$name}}" class="form-label">{{$label}}</label>
    <select id="{{$name.'34'}}"
            name="{{$name}}"
            {{ $required ? 'required' : ''}}
            class="form-select  @error($name) is-invalid @enderror">
        <option value="{{null}}">--Select--</option>
        @foreach($options as $key => $option)
            @php($val = $option->id??$key)
            <option {!!  $val == $value ? 'selected' : ''!!}  value="{{$val}}">
                {{ $option->{$targetColumn} ?? $option }}
            </option>
        @endforeach
    </select>
</div>
