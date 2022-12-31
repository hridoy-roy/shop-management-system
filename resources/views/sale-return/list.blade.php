@extends('layouts.master')
@section('title') {{$title}} @endsection
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
        @slot('li_1')  {{$subTitle}} @endslot
        @slot('title') {{$title}} @endslot
    @endcomponent

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">{{$title}}</h4>
                    <p class="card-title-desc">
                        {{$subTitle}}
                    </p>
                    @include('layouts.report-form', ['path' => 'saleReturns.store'])
                    <div class="table-responsive">
                        <table id="datatable-buttons" class="table table-bordered dt-responsive nowrap w-100">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Sale Num</th>
                                <th>Date</th>
                                <th>Product</th>
                                <th>Rate</th>
                                <th>QTY</th>
                                <th>Amount</th>
                                <th>Unit</th>
                                <th>Type</th>
                                <th>Created By</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($saleReturns as $sale)
                                <tr>
                                    <th scope="row">{{++$loop->index}}</th>
                                    <td>{{$sale->saleReturns->sale_return_num}}</td>
                                    <td>{{$sale->saleReturns->date}}</td>
                                    <td>{{$sale->product->name}}</td>
                                    <td>{{$sale->rate}}</td>
                                    <td>{{$sale->qty}}</td>
                                    <td>{{$sale->amount}}</td>
                                    <td>{{$sale->product->unit_name}}</td>
                                    <td>{{$sale->saleReturns->type}}</td>
                                    <td>{{$sale->saleReturns->created_by}}</td>
                                </tr>
                            @empty
                                <tr class="text-center">
                                    <td colspan="10"><strong class="text-danger">No Data</strong></td>
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
@endsection
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

