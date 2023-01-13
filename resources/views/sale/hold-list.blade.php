@extends('layouts.master')
@section('title')
    {{$title}}
@endsection
@section('css')
    <!-- DataTables -->
    <link href="{{ asset('assets/libs/datatables/datatables.min.css') }}" rel="stylesheet" type="text/css"/>
    <!-- Sweet Alert-->
    <link href="{{ asset('assets/libs/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" type="text/css"/>
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

                    <div class="table-responsive">
                        <table id="datatable-buttons" class="table table-bordered dt-responsive nowrap w-100">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Sale Num</th>
                                <th>Date</th>
                                <th>Customer</th>
                                <th>Amount</th>
                                <th>Discount</th>
                                <th>Type</th>
                                <th>Created By</th>
                                <th class="text-center"><i class="mdi mdi-tools font-size-32 text-warning me-1"></i>
                                </th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($sales as $sale)
                                <tr>
                                    <th scope="row">{{++$loop->index}}</th>
                                    <td>{{$sale->sale_num}}</td>
                                    <td>{{$sale->date}}</td>
                                    <td>{{$sale->customer->name ?? 'N/A'}}</td>
                                    <td>{{$sale->amount}}</td>
                                    <td>{{$sale->discount}}</td>
                                    <td>{{$sale->type}}</td>
                                    <td>{{$sale->created_by}}</td>
                                    <td>
                                        <div class="dropdown text-center">
                                            <a href="#" class="dropdown-toggle card-drop" data-bs-toggle="dropdown"
                                               aria-expanded="false">
                                                <i class="mdi mdi-dots-horizontal font-size-18"></i>
                                            </a>
                                            <ul class="dropdown-menu dropdown-menu-end">
                                                <li><a href="{{route('sales.edit',$sale->id)}}" class="dropdown-item"><i
                                                            class="mdi mdi-pencil font-size-16 text-primary me-1"></i>
                                                        Edit</a></li>
                                                <li>
                                                    <a href="#" onclick="holdConfirm({{$sale->id}})" class="dropdown-item"><i
                                                            class="mdi mdi-cash-check font-size-16 text-success me-1"></i>
                                                        Confirm</a>
                                                </li>
                                                <li><a href="#" class="dropdown-item"
                                                       onclick="holdDelete({{$sale->id}})"><i
                                                            class="mdi mdi-trash-can font-size-16 text-danger me-1"></i>
                                                        Delete</a></li>
                                            </ul>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr class="text-center">
                                    <td colspan="8"><strong class="text-danger">No Data</strong></td>
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
    <script src="{{ asset('assets/libs/datatables/datatables.min.js') }}"></script>
    <script src="{{ asset('assets/libs/jszip/jszip.min.js') }}"></script>
    <script src="{{ asset('assets/libs/pdfmake/pdfmake.min.js') }}"></script>
    <!-- Datatable init js -->
    <script src="{{ asset('assets/js/pages/datatables.init.js') }}"></script>
    <!-- Sweet Alerts js -->
    <script src="{{ asset('assets/libs/sweetalert2/sweetalert2.min.js') }}"></script>

    <!-- Sweet alert init js-->
    <script src="{{ asset('assets/js/pages/sweet-alerts.init.js') }}"></script>
@endsection

@section('script-bottom')
    <script>
        function holdDelete(Id) {
            Swal.fire({
                title: "Are you sure?",
                text: "You won't be able to revert this!",
                icon: "warning",
                showCancelButton: !0,
                confirmButtonText: "Yes, delete it!",
                cancelButtonText: "No, cancel!",
                confirmButtonClass: "btn btn-success mt-2",
                cancelButtonClass: "btn btn-danger ms-2 mt-2",
                buttonsStyling: !1
            }).then(function (t) {
                t.value ?  $.ajax({
                        url: "{{ url('sales') }}" + "/" + Id,
                        type: "delete",
                        data: {
                            "_token": "{{ csrf_token() }}",
                        },
                        success: function (response) {
                            Swal.fire({
                                title: "Deleted!",
                                text: "Hole Info has been deleted.",
                                icon: "success",
                            });
                            setTimeout(location.reload.bind(location), 2000);
                        },
                        error: function (response) {
                            Swal.fire({
                                title: "Fail",
                                text: "Hold Delete Fail",
                                icon: "error"
                            });
                        }
                    }): t.dismiss === Swal.DismissReason.cancel && Swal.fire({
                    title: "Cancelled",
                    text: "Hold Delete Cancelled",
                    icon: "error"
                });
            });
        }


        function holdConfirm(Id) {
            Swal.fire({
                title: "Are you sure?",
                icon: "warning",
                showCancelButton: !0,
                confirmButtonText: "Yes, Confirm it!",
                cancelButtonText: "No, cancel!",
                confirmButtonClass: "btn btn-success mt-2",
                cancelButtonClass: "btn btn-danger ms-2 mt-2",
                buttonsStyling: !1
            }).then(function (t) {
                t.value ?  $.ajax({
                    url: "{{ url('sales/hold/confirm') }}" + "/" + Id,
                    type: "post",
                    data: {
                        "_token": "{{ csrf_token() }}",
                    },
                    success: function (response) {
                        Swal.fire({
                            title: "Confirmed!",
                            text: "Hole Info has been Confirm.",
                            icon: "success",
                        });
                        setTimeout(location.reload.bind(location), 2000);
                    },
                    error: function (response) {
                        Swal.fire({
                            title: "Fail",
                            text: "Hold Confirm Fail",
                            icon: "error"
                        });
                    }
                }): t.dismiss === Swal.DismissReason.cancel && Swal.fire({
                    title: "Cancelled",
                    text: "Hold Confirm Cancelled",
                    icon: "error"
                });
            });
        }
    </script>
@endsection
