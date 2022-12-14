<?php

namespace App\Observers;

use App\Models\SaleDetail;
use App\Models\Stock;

class SaleDetailObserver
{
    /**
     * Handle the SaleDetail "created" event.
     *
     * @param  \App\Models\SaleDetail  $saleDetail
     * @return void
     */
    public function created(SaleDetail $saleDetail)
    {
        $stock = new Stock();
        $stock->product_id = $saleDetail->product_id;
        $stock->product_in = $saleDetail->qty;
        $stock->price = $saleDetail->rate;
        $stock->amount = $saleDetail->amount;
        $stock->tr_no = $saleDetail->sale->id;
        $stock->tr_from = "Sale";
        $stock->lot_no = $saleDetail->sale->id;
        $stock->stocksable_id = $saleDetail->id;
        $stock->stocksable_type = SaleDetail::class;
        $stock->created_by = Auth()->user()->name;
        $stock->saveQuietly();
    }

    /**
     * Handle the SaleDetail "updated" event.
     *
     * @param  \App\Models\SaleDetail  $saleDetail
     * @return void
     */
    public function updated(SaleDetail $saleDetail)
    {
        //
    }

    /**
     * Handle the SaleDetail "deleted" event.
     *
     * @param  \App\Models\SaleDetail  $saleDetail
     * @return void
     */
    public function deleted(SaleDetail $saleDetail)
    {
        //
    }

    /**
     * Handle the SaleDetail "restored" event.
     *
     * @param  \App\Models\SaleDetail  $saleDetail
     * @return void
     */
    public function restored(SaleDetail $saleDetail)
    {
        //
    }

    /**
     * Handle the SaleDetail "force deleted" event.
     *
     * @param  \App\Models\SaleDetail  $saleDetail
     * @return void
     */
    public function forceDeleted(SaleDetail $saleDetail)
    {
        //
    }
}
