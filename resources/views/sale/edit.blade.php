@extends('layouts.master')
@section('title')
    {{$title}}
@endsection

@section('content')

    @component('components.breadcrumb')
        @slot('li_1')
            {{$subTitle}}
        @endslot
        @slot('title')
            {{$title}}
        @endslot
    @endcomponent
    <livewire:sale :sale="$sale"></livewire:sale>
@endsection
@section('script')
    <script src="{{ asset('/assets/libs/parsleyjs/parsleyjs.min.js') }}"></script>
    <script src="{{ asset('/assets/js/pages/form-validation.init.js') }}"></script>
@endsection
