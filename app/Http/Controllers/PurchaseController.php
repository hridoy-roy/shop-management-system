<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\Purchase;
use App\Http\Requests\StorePurchaseRequest;
use App\Http\Requests\UpdatePurchaseRequest;
use App\Models\PurchaseDetail;
use App\Treat\PurchaseId;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Builder;

class PurchaseController extends Controller
{

    use PurchaseId;

    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index(): View|Factory|Application
    {
        $data = [
            'subTitle' => 'Purchase list',
            'title' => 'Purchase',
            'from_date' => date('Y-m-01'),
            'to_date' => date('Y-m-d'),
            'product_id' => '',
            'purchases' => PurchaseDetail::whereHas(
                'purchase', function (Builder $q) {
                $q->whereDate('date', '>=', date('Y-m-01'))->whereDate('date', '<=', date('Y-m-d'));
            })->get(),
            'products' => Product::where('status', '1')->get(),
        ];
        return view('purchases.list', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View
     */
    public function create(): Application|Factory|View
    {
        $data = [
            'subTitle' => 'Purchase',
            'title' => 'Purchase',
        ];
        return view('purchases.index', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \App\Http\Requests\StorePurchaseRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePurchaseRequest $request)
    {
        if ($request->from_date && $request->to_date && $request->product_id) {
            $purchase = PurchaseDetail::whereHas(
                'purchase', function (Builder $q) use ($request) {
                $q->whereDate('date', '>=', $request->from_date)->whereDate('date', '<=', $request->to_date);
            })->where('product_id', $request->product_id)->get();
        } elseif ($request->from_date && $request->to_date) {
            $purchase = PurchaseDetail::whereHas(
                'purchase', function (Builder $q) use ($request) {
                $q->whereDate('date', '>=', $request->from_date)->whereDate('date', '<=', $request->to_date);
            })->get();
        } elseif ($request->product_id) {
            $purchase = PurchaseDetail::where('product_id', $request->product_id)->get();
        } else {
            $purchase = [];
        }

        $data = [
            'subTitle' => 'Purchase list',
            'title' => 'Purchase',
            'from_date' => $request->from_date,
            'to_date' => $request->to_date,
            'product_id' => $request->product_id,
            'purchases' => $purchase,
            'products' => Product::where('status', '1')->get(),
        ];
        return view('purchases.list', $data);
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Purchase $purchase
     * @return \Illuminate\Http\Response
     */
    public function show(Purchase $purchase)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Purchase $purchase
     * @return \Illuminate\Http\Response
     */
    public function edit(Purchase $purchase)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \App\Http\Requests\UpdatePurchaseRequest $request
     * @param \App\Models\Purchase $purchase
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePurchaseRequest $request, Purchase $purchase)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Purchase $purchase
     * @return \Illuminate\Http\Response
     */
    public function destroy(Purchase $purchase)
    {
        //
    }
}
