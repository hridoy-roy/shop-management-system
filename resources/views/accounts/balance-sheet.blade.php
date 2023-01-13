@extends('layouts.master')
@section('title') {{$title}} @endsection
@section('css')
@endsection

@section('content')
    @component('components.breadcrumb')
        @slot('li_1')  {{$subTitle}} @endslot
        @slot('title') {{$title}} @endslot
    @endcomponent

@endsection
