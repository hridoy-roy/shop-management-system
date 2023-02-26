@extends('layouts.master')
@section('title') {{$title}} @endsection
@section('css')
@endsection

@section('content')
    @component('components.breadcrumb')
        @slot('li_1')  {{$subTitle}} @endslot
        @slot('title') {{$title}} @endslot
    @endcomponent
    <div class="row">
        <div class="col-xl-4">
            <div class="card">
                <div class="card-body">

                    <div class="d-flex align-items-start">
                        <div class="flex-shrink-0 me-4">
                            <i class="mdi mdi-account-circle text-primary h1"></i>
                        </div>

                        <div class="flex-grow-1">
                            <div class="text-muted">
                                <h5>{{$siteSettings['shop_name']->value ?? 'N/A'}}</h5>
                                <p class="mb-1">{{$siteSettings['shop_email']->value ?? null}}</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body border-top">

                    <div class="row">
                        <div class="col-sm-6">
                            <div>
                                <p class="text-muted mb-2">Available Balance</p>
                                <h5>{{$cash->total_debit - $cash->total_credit}}</h5>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="text-sm-end mt-4 mt-sm-0">
                                <p class="text-muted mb-2">Since last month</p>
                                <h5>{{$lastMonthlyAccount->total_monthly_debit - $lastMonthlyAccount->total_monthly_credit}}</h5>

                            </div>
                        </div>
                    </div>
                </div>

                <div class="card-body border-top">
                    <p class="text-muted mb-4">In this month</p>
                    <div class="text-center">
                        <div class="row">
                            <div class="col-sm-4">
                                <div>
                                    <div class="font-size-24 text-success mb-2">
                                        <i class="bx bx-import"></i>
                                    </div>

                                    <p class="text-muted mb-2">Total Sale</p>
                                    <h5>{{$monthlyAccount->total_monthly_debit ?? 0}}</h5>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="mt-4 mt-sm-0">
                                    <div class="font-size-24 text-warning mb-2">
                                        <i class="bx bx-export"></i>
                                    </div>

                                    <p class="text-muted mb-2">Total Credit</p>
                                    <h5>{{$monthlyAccount->total_monthly_credit ?? 0}}</h5>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="mt-4 mt-sm-0">
                                    <div class="font-size-24 text-primary mb-2">
                                        <i class="bx bx-wallet"></i>
                                    </div>

                                    <p class="text-muted mb-2">Profit Or Loss</p>
                                    <h5>{{$monthlyAccount->total_monthly_debit - $monthlyAccount->total_monthly_credit}}</h5>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        <div class="col-xl-8">
            <div class="row">
                <div class="col-sm-4">
                    <div class="card mini-stats-wid">
                        <div class="card-body">
                            <div class="d-flex">
                                <div class="flex-shrink-0 me-3 align-self-center">
                                    <i class="bx bx-import h2 text-success mb-0"></i>
                                </div>
                                <div class="flex-grow-1">
                                    <p class="text-muted mb-2">Total Sale</p>
                                    <h5 class="mb-0">{{$account->total_debit ?? 0}}</h5>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="card mini-stats-wid">
                        <div class="card-body">
                            <div class="d-flex">
                                <div class="flex-shrink-0 me-3 align-self-center">
                                    <i class="bx bx-export h2 text-warning mb-0"></i>
                                </div>
                                <div class="flex-grow-1">
                                    <p class="text-muted mb-2">Total Credit</p>
                                    <h5 class="mb-0">{{$account->total_credit ?? 0}}</h5>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="card mini-stats-wid">
                        <div class="card-body">
                            <div class="d-flex">
                                <div class="flex-shrink-0 me-3 align-self-center">
                                    <i class="bx bx-wallet h2 text-info mb-0"></i>
                                </div>
                                <div class="flex-grow-1">
                                    <p class="text-muted mb-2">Profit Or Loss</p>
                                    <h5 class="mb-0">{{$account->total_debit - $account->total_credit}}</h5>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end row -->

            <div class="card">
                <div class="card-body">
                    <h4 class="card-title mb-3">Overview</h4>
                    <div>
                        <div id="overview-chart" class="apex-charts" dir="ltr"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end row -->
@endsection
@section('script')
    <!-- apexcharts -->
    <script src="{{ URL::asset('/assets/libs/apexcharts/apexcharts.min.js') }}"></script>

    <!-- crypto-wallet init -->
    <script src="{{ URL::asset('/assets/js/pages/crypto-wallet.init.js') }}"></script>
@endsection
