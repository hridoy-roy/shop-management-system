@extends('layouts.master')
@section('title')
    {{$title}}
@endsection
@section('css')
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
    <div class="card">
        <div class="card-body">
            <h4 class="card-title mb-4">{{$title}} Create</h4>

            <form class="custom-validation" action="{{route('withdraw.store')}}" method="POST">
                @csrf
                <div class="row">
                    <div class="col-md-6">
                         W{{$withdraw_num}}
                    </div>
                    <div class="col-md-6">
                        <x-forms.select label="Type" name="type"
                                        :options="$utility::$withdraw"></x-forms.select>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <x-forms.input label="Amount" type="number" name="amount"
                                       placeholder="Enter Withdraw Amount"></x-forms.input>
                    </div>
                    <div class="col-md-6">
                        <x-forms.textarea label="Note" type="text" name="note" :required=false
                                          placeholder="Enter Your Note"></x-forms.textarea>
                    </div>
                </div>
                <div class="text-center">
                    <button type="submit" class="btn btn-primary w-md">Save</button>
                </div>
            </form>
        </div>
        <!-- end card body -->
    </div>
@endsection
@section('script')

@endsection
