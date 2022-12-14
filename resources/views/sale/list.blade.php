@extends('layouts.master')
@section('title')
    {{$title}}
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
                        <table class="table mb-0">
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
                            @forelse($sales as $sale)
                                <tr>
                                    <th scope="row">{{++$loop->index}}</th>
                                    <td>{{$sale->sale->purchase_num}}</td>
                                    <td>{{$sale->sale->date}}</td>
                                    <td>{{$sale->product->name}}</td>
                                    <td>{{$sale->rate}}</td>
                                    <td>{{$sale->qty}}</td>
                                    <td>{{$sale->amount}}</td>
                                    <td>{{$sale->product->unit_name}}</td>
                                    <td>{{$sale->sale->type}}</td>
                                    <td>{{$sale->sale->created_by}}</td>
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

