<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Sale;
use App\Http\Requests\StoreSaleRequest;
use App\Http\Requests\UpdateSaleRequest;
use App\Models\SaleDetail;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Builder;
use phpDocumentor\Reflection\Types\True_;

class SaleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index()
    {
        $data = [
            'subTitle' => 'Sale list',
            'title' => 'Sale',
            'from_date' => date('Y-m-01'),
            'to_date' => date('Y-m-d'),
            'product_id' => '',
            'products' => Product::where('status', '1')->get(),
            'sales' => SaleDetail::whereHas(
                'sale', function (Builder $q) {
                $q->whereDate('date', '>=', date('Y-m-01'))
                    ->whereDate('date', '<=', date('Y-m-d'))
                    ->where('type', 'Cash');
            })->get(),
        ];
        return view('sale.list', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = [
            'title' => 'Sale',
            'subTitle' => 'Sale Info',
        ];
        return view('sale.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \App\Http\Requests\StoreSaleRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreSaleRequest $request)
    {
        if ($request->from_date && $request->to_date && $request->product_id) {
            $sales = SaleDetail::whereHas(
                'sale', function (Builder $q) use ($request) {
                $q->whereDate('date', '>=', $request->from_date)
                    ->whereDate('date', '<=', $request->to_date)
                    ->where('type', 'Cash');
            })->where('product_id', $request->product_id)->get();
        } elseif ($request->from_date && $request->to_date) {
            $sales = SaleDetail::whereHas(
                'sale', function (Builder $q) use ($request) {
                $q->whereDate('date', '>=', $request->from_date)
                    ->whereDate('date', '<=', $request->to_date)
                    ->where('type', 'Cash');
            })->get();
        } elseif ($request->product_id) {
            $sales = SaleDetail::whereHas(
                'sale', function (Builder $q) use ($request) {
                $q->where('type', 'Cash');
            })->where('product_id', $request->product_id)->get();
        } else {
            $sales = [];
        }

        $data = [
            'subTitle' => 'Sale list',
            'title' => 'Sale',
            'from_date' => date('Y-m-01'),
            'to_date' => date('Y-m-d'),
            'product_id' => '',
            'products' => Product::where('status', '1')->get(),
            'sales' => $sales,
        ];
        return view('sale.list', $data);
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Sale $sale
     * @return \Illuminate\Http\Response
     */
    public function show(Sale $sale)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Sale $sale
     * @return \Illuminate\Http\Response
     */
    public function edit(Sale $sale)
    {
        $data = [
            'title' => 'Sale Edit',
            'subTitle' => 'Sale Info',
            'sale' => $sale,
        ];
        return view('sale.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \App\Http\Requests\UpdateSaleRequest $request
     * @param \App\Models\Sale $sale
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateSaleRequest $request, Sale $sale)
    {
        dd();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Sale $sale
     * @return bool
     */
    public function destroy(Sale $sale): bool
    {
        if ($sale->saleDetails){
            foreach ($sale->saleDetails as $saleDetail){
                if($saleDetail->stock)
                    $saleDetail->stock->delete();
            }
        }
        return $sale->delete();
    }

    public function holdList(): Factory|View|Application
    {
        $data = [
            'subTitle' => 'Sale Hold list',
            'title' => 'Sale',
            'sales' => Sale::where('type', 'Hold')->latest()->take(2000)->get(),
        ];
        return view('sale.hold-list', $data);
    }


    public function holdConfirm($id)
    {
        return  Sale::find($id)->update(['type' => 'Cash']);
    }

    public function dueList(): Factory|View|Application
    {
        $data = [
            'subTitle' => 'Sale Due list',
            'title' => 'Sale',
            'sales' => Sale::where('type', 'Due')->latest()->take(2000)->get(),
        ];
        return view('sale.due-list', $data);
    }

    public function dueConfirm($id)
    {
        return  Sale::find($id)->update(['type' => 'Cash']);
    }

}
