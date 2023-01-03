@extends('layouts.master')
@section('title')
    {{$title}}
@endsection
@section('css')
    <!-- DataTables -->
    <link href="{{ asset('assets/libs/datatables/datatables.min.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('assets/libs/select2/select2.min.css') }}" rel="stylesheet" type="text/css"/>
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
                                <th>Product name</th>
                                <th>Category</th>
                                <th>Unit</th>
                                <th>Total In</th>
                                <th>Total Out</th>
                                <th>Available</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($stocks as $stock)
                                <tr>
                                    <th scope="row">{{++$loop->index}}</th>
                                    <td>{{$stock->name}}</td>
                                    <td>{{$stock->category->name}}</td>
                                    <td>{{$stock->unit_name}}</td>
                                    <td>{{$stock->total_in}}</td>
                                    <td>{{$stock->total_out}}</td>
                                    <td class="@if(($stock->total_in - $stock->total_out) < \App\Utility\Utility::$minStockValue) text-danger @endif">{{$stock->total_in - $stock->total_out}}</td>
                                </tr>
                            @empty
                                <tr class="text-center">
                                    <td colspan="7"><strong class="text-danger">No Data</strong></td>
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

