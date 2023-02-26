@extends('layouts.master')
@section('title')
    {{$title}}
@endsection
@section('css')
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
                    <div class="invoice-title">
                        <h4 class="float-end font-size-16">Sale Number: {{$sales->sale_num}}</h4>
                        <div class="mb-4">
                            <img src="{{ asset(isset($siteSettings['shop_logo']) ? $siteSettings['shop_logo']->value : null) }}" alt="logo"
                                 height="20"/>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-sm-6">
                            <address>
                                <strong>Billed To:</strong><br>
                                John Smith<br>
                                1234 Main<br>
                                Apt. 4B<br>
                                Springfield, ST 54321
                            </address>
                        </div>
                        <div class="col-sm-6 text-sm-end">
                            <address class="mt-2 mt-sm-0">
                                <strong>Shipped To:</strong><br>
                                Kenny Rigdon<br>
                                1234 Main<br>
                                Apt. 4B<br>
                                Springfield, ST 54321
                            </address>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6 mt-3">
                            <address>
                                <strong>Payment Method:</strong><br>
                                Visa ending **** 4242<br>
                                jsmith@email.com
                            </address>
                        </div>
                        <div class="col-sm-6 mt-3 text-sm-end">
                            <address>
                                <strong>Sale Date:</strong><br>
                                {{$sales->date}}<br><br>
                            </address>
                        </div>
                    </div>
                    <div class="py-2 mt-3">
                        <h3 class="font-size-15 fw-bold">Order summary</h3>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-nowrap">
                            <thead>
                            <tr>
                                <th style="width: 70px;">No.</th>
                                <th>Product (Category)</th>
                                <th class="text-end">Price</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($sales->saleDetails as $sale)
                                <tr>
                                    <td>{{++$loop->index}}</td>
                                    <td>{{$sale->product->name}}, ({{$sale->product->category->name}})</td>
                                    <td class="text-end">{{$sale->amount}}</td>
                                </tr>
                            @endforeach
                            <tr>
                                <td colspan="2" class="text-end">Sub Total</td>
                                <td class="text-end">{{$sales->saleDetails->sum('amount')}}</td>
                            </tr>
                            <tr>
                                <td colspan="2" class="border-0 text-end">
                                    <strong>Discount</strong></td>
                                <td class="border-0 text-end">{{$sales->discount}}</td>
                            </tr>
                            <tr>
                                <td colspan="2" class="border-0 text-end">
                                    <strong>Total</strong></td>
                                <td class="border-0 text-end"><h4 class="m-0">{{$sales->amount}}</h4></td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="d-print-none">
                        <div class="float-end">
                            <a href="javascript:window.print()" class="btn btn-success waves-effect waves-light me-1"><i
                                    class="fa fa-print"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end row -->
@endsection
