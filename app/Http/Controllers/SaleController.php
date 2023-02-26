<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Product;
use App\Models\Sale;
use App\Http\Requests\StoreSaleRequest;
use App\Http\Requests\UpdateSaleRequest;
use App\Models\SaleDetail;
use App\Models\SaleReturn;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use phpDocumentor\Reflection\Types\True_;

class SaleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index(): View|Factory|Application
    {
        $data = [
            'subTitle' => 'Sale list',
            'title' => 'Sale',
            'from_date' => date('Y-m-01'),
            'to_date' => date('Y-m-d'),
            'product_id' => '',
            'products' => Product::where('status', '1')->get(),
            'sales' => Sale::whereDate('date', '>=', date('Y-m-01'))
                ->whereDate('date', '<=', date('Y-m-d'))
                ->where('type', 'Cash')->latest()->get(),
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
     * @return Application|Factory|View
     */
    public function store(StoreSaleRequest $request): View|Factory|Application
    {
        if ($request->from_date && $request->to_date && $request->product_id) {
            $sales = Sale::whereHas(
                'saleDetails', function (Builder $q) use ($request) {
                $q->where('product_id', $request->product_id);
            })->whereDate('date', '>=', $request->from_date)
                ->whereDate('date', '<=', $request->to_date)
                ->where('type', 'Cash')->get();
        } elseif ($request->from_date && $request->to_date) {
            $sales = Sale::whereDate('date', '>=', $request->from_date)
                ->whereDate('date', '<=', $request->to_date)
                ->where('type', 'Cash')->get();
        } elseif ($request->product_id) {
            $sales = Sale::whereHas(
                'saleDetails', function (Builder $q) use ($request) {
                $q->where('product_id', $request->product_id);
            })->where('type', 'Cash')->get();
        } else {
            $sales = [];
        }

        $data = [
            'subTitle' => 'Sale list',
            'title' => 'Sale',
            'from_date' => $request->from_date,
            'to_date' => $request->to_date,
            'product_id' => $request->product_id,
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
        if ($sale->saleDetails) {
            foreach ($sale->saleDetails as $saleDetail) {
                if ($saleDetail->stock)
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
        return Sale::find($id)->update(['type' => 'Cash']);
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
        return Sale::find($id)->update(['type' => 'Cash']);
    }

    public function saleCustomerReport(): Factory|View|Application
    {
        $data = [
            'subTitle' => 'Sale Customer Report',
            'title' => 'Sale Customer',
            'from_date' => '',
            'to_date' => '',
            'customer_id' => null,
            'customers' => Customer::where('status', '1')->get(),
            'sales' => [],
            'salesReturns' => [],
        ];
        return view('sale.customer', $data);
    }

    public function saleCustomerReportPost(Request $request): Factory|View|Application
    {

        $this->validate($request, [
            'from_date' => 'nullable|date|before_or_equal:to_date',
            'to_date' => 'nullable|date|after_or_equal:from_date',
            'customer_id' => 'required',
        ]);


        if ($request->from_date && $request->to_date && $request->customer_id) {
            $sales = Sale::where('customer_id', $request->customer_id)
                ->whereDate('date', '>=', $request->from_date)
                ->whereDate('date', '<=', $request->to_date)->get();
            $saleReturns = SaleReturn::where('customer_id', $request->customer_id)
                ->whereDate('date', '>=', $request->from_date)
                ->whereDate('date', '<=', $request->to_date)->get();

        } elseif ($request->customer_id) {
            $sales = Sale::where('customer_id', $request->customer_id)->get();
            $saleReturns = SaleReturn::where('customer_id', $request->customer_id)->get();
        } else {
            $sales = [];
            $saleReturns = [];
        }

        $data = [
            'subTitle' => 'Sale Customer Report',
            'title' => 'Sale Customer',
            'from_date' => $request->from_date,
            'to_date' => $request->to_date,
            'customer_id' => $request->customer_id,
            'customers' => Customer::where('status', '1')->get(),
            'sales' => $sales,
            'salesReturns' => $saleReturns,
        ];

        return view('sale.customer', $data);
    }

    public function saleReferenceReport(): Factory|View|Application
    {
        $data = [
            'subTitle' => 'Sale Reference Report',
            'title' => 'Sale Reference',
            'from_date' => '',
            'to_date' => '',
            'customer_id' => null,
            'customers' => Customer::where('status', '1')->get(),
            'sales' => [],
            'salesReturns' => [],
        ];
        return view('sale.reference', $data);
    }

    public function saleReferenceReportPost(Request $request): Factory|View|Application
    {
        $this->validate($request, [
            'from_date' => 'nullable|date|before_or_equal:to_date',
            'to_date' => 'nullable|date|after_or_equal:from_date',
            'customer_id' => 'required',
        ]);

        $reference =  Customer::find($request->customer_id) ?? null;

        if ($request->from_date && $request->to_date && $reference) {
            $sales = Sale::where('customer_id', $request->customer_id)
                ->whereDate('date', '>=', $request->from_date)
                ->whereDate('date', '<=', $request->to_date)->get();
            $saleReturns = SaleReturn::where('customer_id', $request->customer_id)
                ->whereDate('date', '>=', $request->from_date)
                ->whereDate('date', '<=', $request->to_date)->get();

        } elseif ($reference) {
            $customerSales = $reference->customers->has('sales');
            $customerSaleReturns = $reference->customers->has('saleReturns');
        }

        $data = [
            'subTitle' => 'Sale Reference Report',
            'title' => 'Sale Reference',
            'from_date' => $request->from_date,
            'to_date' => $request->to_date,
            'customer_id' => $request->customer_id,
            'customers' => Customer::where('status', '1')->get(),
            'customerSales' => $customerSales ?? [],
            'customerSaleReturns' => $customerSaleReturns ?? [],
        ];
        return view('sale.reference', $data);
    }

    public function invoice($id): Factory|View|Application
    {
        $data = [
            'subTitle' => 'Sale Invoice',
            'title' => 'Invoice',
            'sales' => Sale::find($id),
        ];

        return view('sale.invoice', $data);
    }

}
