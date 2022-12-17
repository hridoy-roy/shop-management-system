@extends('layouts.master')
@section('title') {{$title}} @endsection
@section('css')
    <!-- DataTables -->
    <link href="{{ asset('assets/libs/datatables/datatables.min.css') }}" rel="stylesheet" type="text/css" />
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
                    <div class="table-responsive">
                        <table id="datatable-buttons" class="table table-bordered dt-responsive nowrap w-100">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Purchase Num</th>
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
                            @forelse($purchaseReturns as $purchaseReturn)
                                <tr>
                                    <th scope="row">{{++$loop->index}}</th>
                                    <td>{{$purchaseReturn->purchaseReturn->purchase_return_num}}</td>
                                    <td>{{$purchaseReturn->purchaseReturn->date}}</td>
                                    <td>{{$purchaseReturn->product->name}}</td>
                                    <td>{{$purchaseReturn->rate}}</td>
                                    <td>{{$purchaseReturn->qty}}</td>
                                    <td>{{$purchaseReturn->amount}}</td>
                                    <td>{{$purchaseReturn->product->unit_name}}</td>
                                    <td>{{$purchaseReturn->purchaseReturn->type}}</td>
                                    <td>{{$purchaseReturn->purchaseReturn->created_by}}</td>
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

{{--@dd($purchases);--}}
@endsection
@section('script')
    <!-- Required datatable js -->
    <script src="{{ asset('assets/libs/datatables/datatables.min.js') }}"></script>
    <script src="{{ asset('assets/libs/jszip/jszip.min.js') }}"></script>
    <script src="{{ asset('assets/libs/pdfmake/pdfmake.min.js') }}"></script>
    <!-- Datatable init js -->
    <script src="{{ asset('assets/js/pages/datatables.init.js') }}"></script>
@endsection

