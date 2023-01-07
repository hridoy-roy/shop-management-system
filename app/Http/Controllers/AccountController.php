<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Http\Requests\StoreAccountRequest;
use App\Http\Requests\UpdateAccountRequest;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\DB;

class AccountController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \App\Http\Requests\StoreAccountRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreAccountRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Account $account
     * @return \Illuminate\Http\Response
     */
    public function show(Account $account)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Account $account
     * @return \Illuminate\Http\Response
     */
    public function edit(Account $account)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \App\Http\Requests\UpdateAccountRequest $request
     * @param \App\Models\Account $account
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateAccountRequest $request, Account $account)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Account $account
     * @return \Illuminate\Http\Response
     */
    public function destroy(Account $account)
    {
        //
    }


    public function balanceSheet(): Factory|View|Application
    {

        $data = [
            'subTitle' => 'Balance Sheet Report',
            'title' => 'Balance Sheet',
        ];
        return view('accounts.balance-sheet', $data);
    }


    public function profitLoss(): Factory|View|Application
    {
        $data = [
            'subTitle' => 'Profit Loss Report',
            'title' => 'Profit Loss',
            'cash' => Account::where([
                ['transaction_name', '=', 'Sale'],
                ['accountable_type', '=', 'App\Models\Sale'],
            ])->first(
                array(
                    DB::raw('SUM(debit) as total_debit'),
                    DB::raw('SUM(credit) as total_credit'),
                )
            ),
            'monthlyCash' => Account::where([
                ['transaction_name', '=', 'Sale'],
                ['accountable_type', '=', 'App\Models\Sale'],
                ['date', '<=', now('Asia/Dhaka')],
                ['date', '>=', date('Y-m-01')],
            ])->first(
                array(
                    DB::raw('SUM(debit) as total_monthly_debit'),
                    DB::raw('SUM(credit) as total_monthly_credit'),
                )
            ),
        ];
        return view('accounts.profit-loss', $data);
    }
}
