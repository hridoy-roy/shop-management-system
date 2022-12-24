<div class="mb-3">
    <label for="{{$name}}" class="form-label">{{$label}}</label>
    <div class="input-group" id="datepicker2">
        <input type="text"
               name="{{$name}}"
               id="{{$name}}"
               {{ $required ? 'required' : ''}}
               value="{{$value}}"
               class="form-control @error($name) is-invalid @enderror"
               placeholder="yyyy-m-dd"
               data-date-format="yyyy-m-dd" data-date-container='#datepicker2'
               data-provide="datepicker" data-date-autoclose="true">
        <span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
    </div><!-- input-group -->
    @if(!is_array($name))
        @error($name)
        <div class="invalid-feedback d-block">
            {{$message}}
        </div>
        @enderror
    @endif
</div>
