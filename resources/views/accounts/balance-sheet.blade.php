@extends('layouts.master')
@section('title')
    {{$title}}
@endsection
@section('css')
    <style>
        .text-right{
            text-align: right !important;
        }
    </style>
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
                    <h4 class="card-title">{{$subTitle}}</h4>
                    <p class="card-title-desc">
                    </p>

                    <div class="table-responsive">
                        <table class="table table-bordered table-hover mb-5">
                            <thead>
                            <tr class="h1 table-primary">
                                <th>Type</th>
                                <th class="text-right">Amount</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr class="table-success h4">
                                <td>Cash</td>
                                <td class="text-right">{{$cash->total_debit - $cash->total_credit ?? 0}}</td>
                            </tr>
                            <tr class="table-warning h4">
                                <td>Stock</td>
                                @php
                                    $amount = 0;
                                foreach($stocks as $stock){
                                        $amount += $stock->price * ($stock->total_in - $stock->total_out);
                                    }
                                @endphp
                                <td class="text-right">
                                    {{$amount}}
                                </td>
                            </tr>
                            <tr class="table-secondary h4">
                                <td>Total Balance</td>
                                <td class="text-right">
                                    {{$amount + ($cash->total_debit - $cash->total_credit ?? 0)}}
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>

@endsection
