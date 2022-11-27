<button {{ $attributes->merge(['type' => 'submit', 'class' => 'btn btn-primary waves-effect waves-light']) }}>
    {{ $slot }}
</button>
