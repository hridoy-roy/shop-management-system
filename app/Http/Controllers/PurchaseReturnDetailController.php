<?php

namespace App\Http\Controllers;

use App\Models\PurchaseReturnDetail;
use App\Http\Requests\StorePurchaseReturnDetailRequest;
use App\Http\Requests\UpdatePurchaseReturnDetailRequest;

class PurchaseReturnDetailController extends Controller
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
     * @param  \App\Http\Requests\StorePurchaseReturnDetailRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePurchaseReturnDetailRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PurchaseReturnDetail  $purchaseReturnDetail
     * @return \Illuminate\Http\Response
     */
    public function show(PurchaseReturnDetail $purchaseReturnDetail)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PurchaseReturnDetail  $purchaseReturnDetail
     * @return \Illuminate\Http\Response
     */
    public function edit(PurchaseReturnDetail $purchaseReturnDetail)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatePurchaseReturnDetailRequest  $request
     * @param  \App\Models\PurchaseReturnDetail  $purchaseReturnDetail
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePurchaseReturnDetailRequest $request, PurchaseReturnDetail $purchaseReturnDetail)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PurchaseReturnDetail  $purchaseReturnDetail
     * @return \Illuminate\Http\Response
     */
    public function destroy(PurchaseReturnDetail $purchaseReturnDetail)
    {
        //
    }
}
