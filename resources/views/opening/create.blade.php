@extends('layouts.master')
@section('title')
    {{$title}}
@endsection
@section('css')
    <!-- DataTables -->
    <link href="{{ asset('assets/libs/datatables/datatables.min.css') }}" rel="stylesheet" type="text/css"/>
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
        <div class="col-xl-4">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title mb-4">{{$title}} Create</h4>

                    <form class="custom-validation" action="{{route('opening.store')}}" method="POST">
                        @csrf
                        <x-forms.select label="Type" name="type" inputId="openingType"
                                        :options="$utility::$opening"></x-forms.select>
                        <div id="product">
                            <x-forms.select label="Product Name" :required=false name="product_id"
                                            :options="$products"></x-forms.select>

                            <x-forms.input label="Qty" type="number" :required=false name="qty"
                                           placeholder="Enter Product Qty"></x-forms.input>
                        </div>
                        <div id="cash">
                            <x-forms.input label="Cash / Price" type="number" :required=false name="price"
                                           placeholder="Enter Cash / Price"></x-forms.input>
                        </div>
                        <div class="text-center">
                            <button type="submit" class="btn btn-primary w-md">Save</button>
                        </div>
                    </form>
                </div>
                <!-- end card body -->
            </div>
            <!-- end card -->
        </div>
        <!-- end col -->

        <div class="col-xl-8">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <h4 class="card-title">{{$title}} List</h4>

                        <div class="table-responsive">
                            <table id="datatable-buttons" class="table table-bordered dt-responsive nowrap w-100">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Type</th>
                                    <th>Date</th>
                                    <th>Product Name</th>
                                    <th>QTY</th>
                                    <th>Cash/Price</th>
                                    <th>Created by</th>
                                    <th>Updated by</th>
                                </tr>
                                </thead>
                                <tbody>
                                @forelse($openings as $opening)
                                    <tr>
                                        <th scope="row">{{++$loop->index}}</th>
                                        <td>{{$opening->type}}</td>
                                        <td>{{$opening->date}}</td>
                                        <td>{{$opening->product->name ?? "N/A"}}</td>
                                        <td>{{$opening->qty ?? 'N/A'}}</td>
                                        <td>{{$opening->price}}</td>
                                        <td>{{$opening->created_by}}</td>
                                        <td>{{$opening->updated_by}}</td>
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
        </div>
        <!-- end col -->
    </div>
@endsection
@section('script')
    <!-- Required datatable js -->
    <script src="{{ asset('assets/libs/datatables/datatables.min.js') }}"></script>
    <script src="{{ asset('assets/libs/jszip/jszip.min.js') }}"></script>
    <script src="{{ asset('assets/libs/pdfmake/pdfmake.min.js') }}"></script>
    <!-- Datatable init js -->
    <script src="{{ asset('assets/js/pages/datatables.init.js') }}"></script>

    <script>
        $("#openingType").on('click', function () {
            const openingValue = document.getElementById("openingType").value;
            const product = document.getElementById("product");
            const cash = document.getElementById("cash");

            if (openingValue === 'Cash_Opening') {
                product.style.display = 'none';
                cash.style.display = 'block';

            } else if (openingValue === 'Item_Opening') {
                product.style.display = 'block';
                cash.style.display = 'block';

            }
        });


    </script>
@endsection
