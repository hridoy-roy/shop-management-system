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
                                <h5>Henry Wells</h5>
                                <p class="mb-1">henrywells@abc.com</p>
                                <p class="mb-0">Id no: #SK0234</p>
                            </div>

                        </div>

                        <div class="dropdown ms-2">
                            <a class="text-muted" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="mdi mdi-dots-horizontal font-size-18"></i>
                            </a>

                            <div class="dropdown-menu dropdown-menu-end">
                                <a class="dropdown-item" href="#">Action</a>
                                <a class="dropdown-item" href="#">Another action</a>
                                <a class="dropdown-item" href="#">Something else here</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body border-top">

                    <div class="row">
                        <div class="col-sm-6">
                            <div>
                                <p class="text-muted mb-2">Available Balance</p>
                                <h5>$ 9148.23</h5>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="text-sm-end mt-4 mt-sm-0">
                                <p class="text-muted mb-2">Since last month</p>
                                <h5>+ $ 248.35 <span class="badge bg-success ms-1 align-bottom">+ 1.3 %</span></h5>

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
                                    <div class="font-size-24 text-primary mb-2">
                                        <i class="bx bx-send"></i>
                                    </div>

                                    <p class="text-muted mb-2">Total Sale</p>
                                    <h5>{{$monthlyCash->total_monthly_debit ?? 0}}</h5>

                                    <div class="mt-3">
                                        <a href="javascript: void(0);" class="btn btn-primary btn-sm w-md">Send</a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="mt-4 mt-sm-0">
                                    <div class="font-size-24 text-primary mb-2">
                                        <i class="bx bx-import"></i>
                                    </div>

                                    <p class="text-muted mb-2">Total Credit</p>
                                    <h5>{{$monthlyCash->total_monthly_credit ?? 0}}</h5>

                                    <div class="mt-3">
                                        <a href="javascript: void(0);" class="btn btn-primary btn-sm w-md">Receive</a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="mt-4 mt-sm-0">
                                    <div class="font-size-24 text-primary mb-2">
                                        <i class="bx bx-wallet"></i>
                                    </div>

                                    <p class="text-muted mb-2">Profit Or Loss</p>
                                    <h5>{{$monthlyCash->total_monthly_debit - $monthlyCash->total_monthly_credit}}</h5>

                                    <div class="mt-3">
                                        <a href="javascript: void(0);" class="btn btn-primary btn-sm w-md">Withdraw</a>
                                    </div>
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
                                    <i class="mdi mdi-bitcoin h2 text-warning mb-0"></i>
                                </div>
                                <div class="flex-grow-1">
                                    <p class="text-muted mb-2">Total Sale</p>
                                    <h5 class="mb-0">{{$cash->total_debit ?? 0}}</h5>
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
                                    <i class="mdi mdi-ethereum h2 text-primary mb-0"></i>
                                </div>
                                <div class="flex-grow-1">
                                    <p class="text-muted mb-2">Total Credit</p>
                                    <h5 class="mb-0">{{$cash->total_credit ?? 0}}</h5>
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
                                    <i class="mdi mdi-litecoin h2 text-info mb-0"></i>
                                </div>
                                <div class="flex-grow-1">
                                    <p class="text-muted mb-2">Profit Or Loss</p>
                                    <h5 class="mb-0">{{$cash->total_debit - $cash->total_credit}}</h5>
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
