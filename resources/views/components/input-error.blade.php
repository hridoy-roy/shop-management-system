@props(['messages'])

@if ($messages)
    <span {{ $attributes->merge(['class' => 'invalid-feedback']) }}  role="alert">
        @foreach ((array) $messages as $message)
            <strong>{{ $message }}</strong>
        @endforeach
    </span>
@endif
