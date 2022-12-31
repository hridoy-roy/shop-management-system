<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\SaleReturn;
use App\Http\Requests\StoreSaleReturnRequest;
use App\Http\Requests\UpdateSaleReturnRequest;
use App\Models\SaleReturnDetail;
use Illuminate\Database\Eloquent\Builder;

class SaleReturnController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = [
            'subTitle' => 'Sale Return list',
            'title' => 'Sale Return',
            'from_date' => date('Y-m-01'),
            'to_date' => date('Y-m-d'),
            'product_id' => '',
            'products' => Product::where('status', '1')->get(),
            'saleReturns' => SaleReturnDetail::whereHas(
                'saleReturns', function (Builder $q) {
                $q->whereDate('date', '>=', date('Y-m-01'))
                    ->whereDate('date', '<=', date('Y-m-d'));
            })->get(),
        ];
        return view('sale-return.list', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = [
            'title' => 'Sale Return',
            'subTitle' => 'Sale Return Info',
        ];
        return view('sale-return.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreSaleReturnRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreSaleReturnRequest $request)
    {
        if ($request->from_date && $request->to_date && $request->product_id) {
            $saleReturns = SaleReturnDetail::whereHas(
                'saleReturns', function (Builder $q) use ($request) {
                $q->whereDate('date', '>=', $request->from_date)
                    ->whereDate('date', '<=', $request->to_date);
            })->where('product_id', $request->product_id)->get();
        } elseif ($request->from_date && $request->to_date) {
            $saleReturns = SaleReturnDetail::whereHas(
                'saleReturns', function (Builder $q) use ($request) {
                $q->whereDate('date', '>=', $request->from_date)
                    ->whereDate('date', '<=', $request->to_date);
            })->get();
        } elseif ($request->product_id) {
            $saleReturns = SaleReturnDetail::where('product_id', $request->product_id)->get();
        } else {
            $saleReturns = [];
        }

        $data = [
            'subTitle' => 'Sale Return list',
            'title' => 'Sale Return',
            'from_date' => $request->from_date,
            'to_date' => $request->to_date,
            'product_id' => $request->product_id,
            'products' => Product::where('status', '1')->get(),
            'saleReturns' => $saleReturns,
        ];
        return view('sale-return.list', $data);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\SaleReturn  $saleReturn
     * @return \Illuminate\Http\Response
     */
    public function show(SaleReturn $saleReturn)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\SaleReturn  $saleReturn
     * @return \Illuminate\Http\Response
     */
    public function edit(SaleReturn $saleReturn)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateSaleReturnRequest  $request
     * @param  \App\Models\SaleReturn  $saleReturn
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateSaleReturnRequest $request, SaleReturn $saleReturn)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SaleReturn  $saleReturn
     * @return \Illuminate\Http\Response
     */
    public function destroy(SaleReturn $saleReturn)
    {
        //
    }
}
