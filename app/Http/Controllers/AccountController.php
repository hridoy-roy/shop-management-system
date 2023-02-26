<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Http\Requests\StoreAccountRequest;
use App\Http\Requests\UpdateAccountRequest;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\DB;

class AccountController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index(): View|Factory|Application
    {
        $data = [
            'subTitle' => 'Profit Loss Date wise list',
            'title' => 'Profit Loss',
            'from_date' => date('Y-m-01'),
            'to_date' => date('Y-m-d'),
            'accounts' => Account::whereDate('date', '>=', date('Y-m-01'))
                ->whereDate('date', '<=', date('Y-m-d'))
                ->where([
                    ['transaction_name', '=', 'Sale'],
                    ['accountable_type', '=', 'App\Models\Sale'],
                ])->latest()->get(),
        ];
        return view('accounts.date-profit-loss', $data);

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
     * @return Application|Factory|View
     */
    public function store(StoreAccountRequest $request): View|Factory|Application
    {
        if ($request->from_date && $request->to_date) {
            $accounts = Account::whereDate('date', '>=', $request->from_date)
                ->whereDate('date', '<=', $request->to_date)
                ->where([
                    ['transaction_name', '=', 'Sale'],
                    ['accountable_type', '=', 'App\Models\Sale'],
                ])->get();
        } else {
            $accounts = [];
        }

        $data = [
            'subTitle' => 'Profit Loss Date wise list',
            'title' => 'Profit Loss',
            'from_date' => $request->from_date,
            'to_date' => $request->to_date,
            'accounts' => $accounts,
        ];
        return view('accounts.date-profit-loss', $data);
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
            'cash' => Account::where('leaser_name', 'Cash')->first(
                array(
                    DB::raw('SUM(debit) as total_debit'),
                    DB::raw('SUM(credit) as total_credit'),
                )
            ),
            'stocks' => Product::has('stock')
                ->withSum('stock as total_in', 'product_in')
                ->withSum('stock as total_out', 'product_out')
                ->get(),
        ];
        return view('accounts.balance-sheet', $data);
    }


    public function profitLoss(): Factory|View|Application
    {
        $data = [
            'subTitle' => 'Profit Loss Report',
            'title' => 'Profit Loss',
            'cash' => Account::where('leaser_name', 'Cash')->first(
                array(
                    DB::raw('SUM(debit) as total_debit'),
                    DB::raw('SUM(credit) as total_credit'),
                )
            ),
            'account' => Account::where([
                ['transaction_name', '=', 'Sale'],
                ['accountable_type', '=', 'App\Models\Sale'],
            ])->first(
                array(
                    DB::raw('SUM(debit) as total_debit'),
                    DB::raw('SUM(credit) as total_credit'),
                )
            ),
            'monthlyAccount' => Account::where([
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
            'lastMonthlyAccount' => Account::where([
                ['transaction_name', '=', 'Sale'],
                ['accountable_type', '=', 'App\Models\Sale'],
                ['date', '<=', Carbon::now()->subMonth()->endOfMonth()],
                ['date', '>=', Carbon::now()->subMonth()->startOfMonth()],
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
