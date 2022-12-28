<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Stock;
use App\Http\Requests\StoreStockRequest;
use App\Http\Requests\UpdateStockRequest;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Response;

class StockController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index(): Application|Factory|View
    {
        $data = [
            'subTitle' => 'Stock list',
            'title' => 'Stock',
            'stocks' => Product::has('stock')
                ->withSum('stock as total_in', 'product_in')
                ->withSum('stock as total_out', 'product_out')
                ->get(),
        ];
        return view('stock.present', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View
     */
    public function create(): View|Factory|Application
    {
        $data = [
            'subTitle' => 'Stock Transaction list',
            'title' => 'Stock Transaction',
            'from_date' => date('Y-m-01'),
            'to_date' => date('Y-m-d'),
            'products' => Product::where('status', '1')->get(),
            'type' => '',
            'product_id' => '',
            'stocks' => Stock::whereDate('date', '>=', date('Y-m-01'))->whereDate('date', '<=', date('Y-m-d'))->get(),
        ];
        return view('stock.transaction', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \App\Http\Requests\StoreStockRequest $request
     * @return Response
     */
    public function store(StoreStockRequest $request)
    {
        if ($request->from_date && $request->to_date && $request->product_id) {
            $stocks = Stock::whereHas(
                'purchase', function (Builder $q) use ($request) {
                $q->whereDate('date', '>=', $request->from_date)->whereDate('date', '<=', $request->to_date);
            })->where('product_id', $request->product_id)->get();
        } elseif ($request->from_date && $request->to_date) {
            $stocks = $stocks = Stock::whereHas(
                'purchase', function (Builder $q) use ($request) {
                $q->whereDate('date', '>=', $request->from_date)->whereDate('date', '<=', $request->to_date);
            })->get();
        } elseif ($request->product_id) {
            $stocks = Stock::where('product_id', $request->product_id)->get();
        } else {
            $stocks = [];
        }

        $data = [
            'subTitle' => 'Stock Transaction list',
            'title' => 'Stock Transaction',
            'from_date' => $request->from_date,
            'to_date' => $request->to_date,
            'product_id' => $request->product_id,
            'stocks' => $stocks,
            'products' => Product::where('status', '1')->get(),
        ];
        return view('stock.transaction', $data);
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Stock $stock
     * @return Response
     */
    public function show(Stock $stock)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Stock $stock
     * @return Response
     */
    public function edit(Stock $stock)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \App\Http\Requests\UpdateStockRequest $request
     * @param \App\Models\Stock $stock
     * @return Response
     */
    public function update(UpdateStockRequest $request, Stock $stock)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Stock $stock
     * @return Response
     */
    public function destroy(Stock $stock)
    {
        //
    }
}
