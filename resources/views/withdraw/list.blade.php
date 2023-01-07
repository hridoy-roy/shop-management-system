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
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <h4 class="card-title">{{$title}} List</h4>

                <div class="table-responsive">
                    <table id="datatable-buttons" class="table table-bordered dt-responsive nowrap w-100">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Withdraw number</th>
                            <th>Type</th>
                            <th>Date</th>
                            <th>Amount</th>
                            <th>Note</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($withdraws as $withdraw)
                            <tr>
                                <th scope="row">{{++$loop->index}}</th>
                                <td>{{$withdraw->withdraw_num}}</td>
                                <td>{{$withdraw->type}}</td>
                                <td>{{$withdraw->date}}</td>
                                <td>{{$withdraw->amount}}</td>
                                <td>{{$withdraw->nite}}</td>
                                <td>
                                    <div class="dropdown text-center">
                                        <a href="#" class="dropdown-toggle card-drop" data-bs-toggle="dropdown"
                                           aria-expanded="false">
                                            <i class="mdi mdi-dots-horizontal font-size-18"></i>
                                        </a>
                                        <ul class="dropdown-menu dropdown-menu-end">
                                            <li><a href="{{route('withdraw.edit',$withdraw->id)}}" class="dropdown-item"><i
                                                        class="mdi mdi-pencil font-size-16 text-primary me-1"></i>
                                                    Edit</a></li>
                                            <li><a href="#" class="dropdown-item"
                                                   onclick="holdDelete({{$withdraw->id}})"><i
                                                        class="mdi mdi-trash-can font-size-16 text-danger me-1"></i>
                                                    Delete</a></li>
                                        </ul>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center text-danger"><strong>No Data</strong></td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
        <!-- end card body -->
    </div>
    <!-- end card -->
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
                    url: "{{ url('withdraw') }}" + "/" + Id,
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
    </script>
@endsection
