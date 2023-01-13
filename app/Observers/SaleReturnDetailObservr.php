<?php

namespace App\Observers;

use App\Models\SaleReturnDetail;
use App\Models\Stock;

class SaleReturnDetailObservr
{
    /**
     * Handle the SaleReturnDetail "created" event.
     *
     * @param \App\Models\SaleReturnDetail $saleReturnDetail
     * @return void
     */
    public function created(SaleReturnDetail $saleReturnDetail)
    {
        $stock = new Stock();
        $stock->product_id = $saleReturnDetail->product_id;
        $stock->product_in = $saleReturnDetail->qty;
        $stock->price = $saleReturnDetail->rate;
        $stock->amount = $saleReturnDetail->amount;
        $stock->tr_no = $saleReturnDetail->saleReturns->sale_return_num;
        $stock->tr_from = "SaleReturn";
        $stock->lot_no = $saleReturnDetail->saleReturns->id;
        $stock->stocksable_id = $saleReturnDetail->id;
        $stock->stocksable_type = SaleReturnDetail::class;
        $stock->created_by = Auth()->user()->name ?? 'seeder';
        $stock->saveQuietly();
    }

    /**
     * Handle the SaleReturnDetail "updated" event.
     *
     * @param \App\Models\SaleReturnDetail $saleReturnDetail
     * @return void
     */
    public function updated(SaleReturnDetail $saleReturnDetail)
    {
        //
    }

    /**
     * Handle the SaleReturnDetail "deleted" event.
     *
     * @param \App\Models\SaleReturnDetail $saleReturnDetail
     * @return void
     */
    public function deleted(SaleReturnDetail $saleReturnDetail)
    {
        //
    }

    /**
     * Handle the SaleReturnDetail "restored" event.
     *
     * @param \App\Models\SaleReturnDetail $saleReturnDetail
     * @return void
     */
    public function restored(SaleReturnDetail $saleReturnDetail)
    {
        //
    }

    /**
     * Handle the SaleReturnDetail "force deleted" event.
     *
     * @param \App\Models\SaleReturnDetail $saleReturnDetail
     * @return void
     */
    public function forceDeleted(SaleReturnDetail $saleReturnDetail)
    {
        //
    }
}
