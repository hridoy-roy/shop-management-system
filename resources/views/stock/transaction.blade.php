@extends('layouts.master')
@section('title')
    {{$title}}
@endsection
@section('css')
    <!-- DataTables -->
    <link href="{{ asset('assets/libs/datatables/datatables.min.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('assets/libs/select2/select2.min.css') }}" rel="stylesheet" type="text/css"/>
    <!-- form BT DataPicker -->
    <link href="{{ asset('assets/libs/bootstrap-datepicker/bootstrap-datepicker.min.css') }}" rel="stylesheet"
          type="text/css">
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

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">{{$title}}</h4>
                    <p class="card-title-desc">
                        {{$subTitle}}
                    </p>
                    <form class="row row-cols-lg-auto g-3 align-items-center justify-content-center mb-3" action="{{route('stock.store')}}" method="post">
                        @csrf
                        <div class="col-12">
                            <x-forms.input-date label="From Date" name="from_date" :required="false" value="{{$from_date}}"></x-forms.input-date>
                        </div>
                        <div class="col-12">
                            <x-forms.input-date label="To Date" name="to_date" :required="false" value="{{$to_date}}"></x-forms.input-date>
                        </div>

                        <div class="col-12">
                            <x-forms.select label="Product Name" name="product_id"
                                            :options="$products" :required="false" value={{$product_id}} ></x-forms.select>
                        </div>
                        <div class="col-12">
                            <x-forms.select label="Type" name="type"
                                            :options="$types" :required="false" value={{$type}} ></x-forms.select>
                        </div>

                        <div class="col-12">
                            <button type="submit" class="btn btn-primary w-md mt-2">Submit</button>
                        </div>
                    </form>
                    <div class="table-responsive">
                        <table id="datatable-buttons" class="table table-bordered dt-responsive nowrap w-100">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Product</th>
                                <th>Date</th>
                                <th>In</th>
                                <th>Out</th>
                                <th>Rate</th>
                                <th>Amount</th>
                                <th>Type</th>
                                <th>Created By</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($stocks as $stock)
                                <tr>
                                    <th scope="row">{{++$loop->index}}</th>
                                    <td>{{$stock->product->name}}</td>
                                    <td>{{$stock->date}}</td>
                                    <td>{{$stock->product_in}}</td>
                                    <td>{{$stock->product_out}}</td>
                                    <td>{{$stock->price}}</td>
                                    <td>{{$stock->amount}}</td>
                                    <td>{{$stock->tr_from}}</td>
                                    <td>{{$stock->created_by}}</td>
                                </tr>
                            @empty
                                <tr class="text-center">
                                    <td colspan="9"><strong class="text-danger">No Data</strong></td>
                                </tr>
                            @endforelse
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <!-- end row -->
@endSection
@section('script')
    <!-- Required datatable js -->
    <script src="{{ asset('assets/libs/select2/select2.min.js') }}"></script>
    <script src="{{ asset('assets/libs/datatables/datatables.min.js') }}"></script>
    <script src="{{ asset('assets/libs/jszip/jszip.min.js') }}"></script>
    <script src="{{ asset('assets/libs/pdfmake/pdfmake.min.js') }}"></script>
    <script src="{{ asset('assets/libs/bootstrap-datepicker/bootstrap-datepicker.min.js') }}"></script>
    <!-- Datatable init js -->
    <script src="{{ asset('assets/js/pages/datatables.init.js') }}"></script>

@endsection

