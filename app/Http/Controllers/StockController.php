<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Stock;
use App\Http\Requests\StoreStockRequest;
use App\Http\Requests\UpdateStockRequest;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
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
     * @return Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \App\Http\Requests\StoreStockRequest $request
     * @return Response
     */
    public function store(StoreStockRequest $request)
    {
        //
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
