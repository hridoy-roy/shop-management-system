<?php

namespace App\Http\Controllers;

use App\Models\SaleReturnDetail;
use App\Http\Requests\StoreSaleReturnDetailRequest;
use App\Http\Requests\UpdateSaleReturnDetailRequest;

class SaleReturnDetailController extends Controller
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
     * @param  \App\Http\Requests\StoreSaleReturnDetailRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreSaleReturnDetailRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\SaleReturnDetail  $saleReturnDetail
     * @return \Illuminate\Http\Response
     */
    public function show(SaleReturnDetail $saleReturnDetail)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\SaleReturnDetail  $saleReturnDetail
     * @return \Illuminate\Http\Response
     */
    public function edit(SaleReturnDetail $saleReturnDetail)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateSaleReturnDetailRequest  $request
     * @param  \App\Models\SaleReturnDetail  $saleReturnDetail
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateSaleReturnDetailRequest $request, SaleReturnDetail $saleReturnDetail)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SaleReturnDetail  $saleReturnDetail
     * @return \Illuminate\Http\Response
     */
    public function destroy(SaleReturnDetail $saleReturnDetail)
    {
        //
    }
}
