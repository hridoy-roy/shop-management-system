<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\PurchaseReturn;
use App\Http\Requests\StorePurchaseReturnRequest;
use App\Http\Requests\UpdatePurchaseReturnRequest;
use App\Models\PurchaseReturnDetail;
use Illuminate\Database\Eloquent\Builder;

class PurchaseReturnController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        $data = [
            'subTitle' => 'Purchase Return list',
            'title' => 'Purchase Return',
            'from_date' => date('Y-m-01'),
            'to_date' => date('Y-m-d'),
            'product_id' => '',
            'products' => Product::where('status', '1')->get(),
            'purchaseReturns' => PurchaseReturnDetail::whereHas(
                'purchaseReturn', function (Builder $q) {
                $q->whereDate('date', '>=', date('Y-m-01'))->whereDate('date', '<=', date('Y-m-d'));
            })->get(),
        ];
        return view('purchase-return.list', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function create()
    {
        $data = [
            'subTitle' => 'Purchase Return Create',
            'title' => 'Purchase Return',
        ];
        return view('purchase-return.index', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StorePurchaseReturnRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePurchaseReturnRequest $request)
    {
        if ($request->from_date && $request->to_date && $request->product_id) {
            $purchaseReturns = PurchaseReturnDetail::whereHas(
                'purchaseReturn', function (Builder $q) use ($request) {
                $q->whereDate('date', '>=', $request->from_date)
                    ->whereDate('date', '<=', $request->to_date);
            })->where('product_id', $request->product_id)->get();
        } elseif ($request->from_date && $request->to_date) {
            $purchaseReturns = PurchaseReturnDetail::whereHas(
                'purchaseReturn', function (Builder $q) use ($request) {
                $q->whereDate('date', '>=', $request->from_date)
                    ->whereDate('date', '<=', $request->to_date);
            })->get();
        } elseif ($request->product_id) {
            $purchaseReturns = PurchaseReturnDetail::where('product_id', $request->product_id)->get();
        } else {
            $purchaseReturns = [];
        }

        $data = [
            'subTitle' => 'Purchase Return list',
            'title' => 'Purchase Return',
            'from_date' => $request->from_date,
            'to_date' => $request->to_date,
            'product_id' => $request->product_id,
            'products' => Product::where('status', '1')->get(),
            'purchaseReturns' => $purchaseReturns,
        ];
        return view('purchase-return.list', $data);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PurchaseReturn  $purchaseReturn
     * @return \Illuminate\Http\Response
     */
    public function show(PurchaseReturn $purchaseReturn)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PurchaseReturn  $purchaseReturn
     * @return \Illuminate\Http\Response
     */
    public function edit(PurchaseReturn $purchaseReturn)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatePurchaseReturnRequest  $request
     * @param  \App\Models\PurchaseReturn  $purchaseReturn
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePurchaseReturnRequest $request, PurchaseReturn $purchaseReturn)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PurchaseReturn  $purchaseReturn
     * @return \Illuminate\Http\Response
     */
    public function destroy(PurchaseReturn $purchaseReturn)
    {
        //
    }
}
