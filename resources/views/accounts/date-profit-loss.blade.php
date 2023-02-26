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
                    <form class="row row-cols-lg-auto g-3 align-items-center justify-content-center mb-3" action="{{route('accounts.store')}}" method="post">
                        @csrf
                        <div class="col-12">
                            <x-forms.input-date label="From Date" name="from_date" :required="false" value="{{$from_date}}"></x-forms.input-date>
                        </div>
                        <div class="col-12">
                            <x-forms.input-date label="To Date" name="to_date" :required="false" value="{{$to_date}}"></x-forms.input-date>
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
                                <th>Num</th>
                                <th>Date</th>
                                <th>In</th>
                                <th>Out</th>
                                <th>Note</th>
                                <th>Type</th>
                                <th>Created By</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($accounts as $account)
                                <tr>
                                    <th scope="row">{{++$loop->index}}</th>
                                    <td>{{$account->transaction_num}}</td>
                                    <td>{{$account->date}}</td>
                                    <td>{{$account->debit}}</td>
                                    <td>{{$account->credit}}</td>
                                    <td>{{$account->note ?? 'N/A'}}</td>
                                    <td>{{$account->transaction_name}}</td>
                                    <td>{{$account->created_by}}</td>
                                </tr>
                            @empty
                                <tr class="text-center">
                                    <td colspan="10"><strong class="text-danger">No Data</strong></td>
                                </tr>
                            @endforelse
                            </tbody>
                            <tfoot>
                            <tr>
                                <th colspan="5" style="text-align:right">Total:</th>
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
@endSection
@section('script')
    <!-- Required datatable js -->
    <script src="{{ asset('assets/libs/select2/select2.min.js') }}"></script>
    <script src="{{ asset('assets/libs/datatables/datatables.min.js') }}"></script>
    <script src="{{ asset('assets/libs/jszip/jszip.min.js') }}"></script>
    <script src="{{ asset('assets/libs/pdfmake/pdfmake.min.js') }}"></script>
    <script src="{{ asset('assets/libs/bootstrap-datepicker/bootstrap-datepicker.min.js') }}"></script>
    <!-- Datatable init js -->
    <script>
        /******/ (function() { // webpackBootstrap
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
                        let totalDebit = api
                            .column(3)
                            .data()
                            .reduce(function (a, b) {
                                return intVal(a) + intVal(b);
                            }, 0);
                        // Total over all pages
                        let totalCredit = api
                            .column(4)
                            .data()
                            .reduce(function (a, b) {
                                return intVal(a) + intVal(b);
                            }, 0);

                        // Total over this page
                        let pageTotalDebit = api
                            .column(3, {page: 'current'})
                            .data()
                            .reduce(function (a, b) {
                                return intVal(a) + intVal(b);
                            }, 0);
                        let pageTotalCredit = api
                            .column(4, {page: 'current'})
                            .data()
                            .reduce(function (a, b) {
                                return intVal(a) + intVal(b);
                            }, 0);

                        // Update footer
                        $(api.column(6).footer()).html('৳: ' + (pageTotalDebit - pageTotalCredit)  + ' ( ৳: ' + (totalDebit - totalCredit) + ' total)');
                    },
                    ordering: false,
                    lengthChange: !1,
                    buttons: [
                        {
                            extend:    'copyHtml5',
                            text:      '<i class="far fa-copy text-dark h4 mb-0"></i>',
                            titleAttr: 'Copy'
                        },
                        {
                            extend:    'excelHtml5',
                            text:      '<i class="fas fa-file-excel text-success h4 mb-0"></i>',
                            titleAttr: 'Excel'
                        },
                        {
                            extend:    'csvHtml5',
                            text:      '<i class="fas fa-file-csv text-info h4 mb-0"></i>',
                            titleAttr: 'CSV'
                        },
                        {
                            extend:    'pdfHtml5',
                            text:      '<i class="fas fa-file-pdf text-danger h4 mb-0"></i>',
                            titleAttr: 'PDF'
                        }
                    ]
                }).buttons().container().appendTo("#datatable-buttons_wrapper .col-md-6:eq(0)"), $(".dataTables_length select").addClass("form-select form-select-sm");
            });
            /******/ })()
        ;
    </script>
@endsection

