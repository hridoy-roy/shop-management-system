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
                    @include('layouts.report-form', ['path' => 'sales.store'])
                    <div class="table-responsive">
                        <table id="datatable-buttons" class="table table-bordered text-center dt-responsive nowrap w-100">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Date</th>
                                <th>Discount</th>
                                <th>Amount</th>
                                <th>Sale Num</th>
                                <th>Product</th>
                                <th>QTY</th>
                                <th>Unit</th>
                                <th>Created By</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($sales as $sale)
                                @foreach($sale->saleDetails as $saleDetail)
                                    <tr>
                                        @if($loop->first)
                                            <th scope="row">{{++$loop->parent->index}}</th>
                                            <td>{{$sale->date}}</td>
                                            <td>{{$sale->discount}}</td>
                                            <td>{{$sale->amount}}</td>
                                        @else
                                            <th></th>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                        @endif
                                        <td>{{$sale->sale_num}}</td>
                                        <td>{{$saleDetail->product->name}}</td>
                                        <td>{{$saleDetail->qty}}</td>
                                        <td>{{$saleDetail->product->unit_name}}</td>
                                        @if($loop->first)
                                            <td>{{$sale->created_by}}</td>
                                            <td>
                                                <a href="{{route('sale.invoice',$sale->id)}}" target="_blank"
                                                   class="btn btn-primary waves-effect btn-label waves-light">
                                                    <i class="bx bx-receipt label-icon"></i>Invoice
                                                </a>
                                            </td>
                                        @else
                                            <td></td>
                                            <td></td>
                                        @endif
                                    </tr>
                                @endforeach
                            @empty
                                <tr class="text-center">
                                    <td colspan="10"><strong class="text-danger">No Data</strong></td>
                                </tr>
                            @endforelse
                            </tbody>
                            <tfoot>
                            <tr>
                                <th colspan="7" style="text-align:right">Total:</th>
                                <th colspan="3"></th>
                            </tr>
                            </tfoot>
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
    <script>
        /******/
        (function () { // webpackBootstrap
            var __webpack_exports__ = {};
            /*!***********************************************!*\
              !*** ./resources/js/pages/datatables.init.js ***!
              \***********************************************/
            $(document).ready(function () {
                $("#datatable").DataTable(), $("#datatable-buttons").DataTable({
                    footerCallback: function (row, data, start, end, display) {
                        let api = this.api();

                        // Remove the formatting to get integer data for summation
                        let intVal = function (i) {
                            return typeof i === 'string' ? i * 1 : typeof i === 'number' ? i : 0;
                        };

                        // Total over all pages
                        let total = api
                            .column(3)
                            .data()
                            .reduce(function (a, b) {
                                return intVal(a) + intVal(b);
                            }, 0);

                        // Total over this page
                        let pageTotal = api
                            .column(3, {page: 'current'})
                            .data()
                            .reduce(function (a, b) {
                                return intVal(a) + intVal(b);
                            }, 0);

                        // Update footer
                        $(api.column(7).footer()).html('৳: ' + pageTotal + ' ( ৳: ' + total + ' total)');
                    },
                    ordering: false,
                    lengthChange: !1,
                    buttons: [
                        {
                            extend: 'copyHtml5',
                            text: '<i class="far fa-copy text-dark h4 mb-0"></i>',
                            titleAttr: 'Copy'
                        },
                        {
                            extend: 'excelHtml5',
                            text: '<i class="fas fa-file-excel text-success h4 mb-0"></i>',
                            titleAttr: 'Excel'
                        },
                        {
                            extend: 'csvHtml5',
                            text: '<i class="fas fa-file-csv text-info h4 mb-0"></i>',
                            titleAttr: 'CSV'
                        },
                        {
                            extend: 'pdfHtml5',
                            text: '<i class="fas fa-file-pdf text-danger h4 mb-0"></i>',
                            titleAttr: 'PDF'
                        }
                    ]
                }).buttons().container().appendTo("#datatable-buttons_wrapper .col-md-6:eq(0)"), $(".dataTables_length select").addClass("form-select form-select-sm");
            });
            /******/
        })()
        ;
    </script>
@endsection

