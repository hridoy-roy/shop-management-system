<?php

namespace App\Observers;

use App\Models\PurchaseReturnDetail;
use App\Models\Stock;

class PurchaseReturnDetailObservr
{
    /**
     * Handle the PurchaseReturnDetail "created" event.
     *
     * @param  \App\Models\PurchaseReturnDetail  $purchaseReturnDetail
     * @return void
     */
    public function created(PurchaseReturnDetail $purchaseReturnDetail)
    {
        $stock = new Stock();
        $stock->product_id = $purchaseReturnDetail->product_id;
        $stock->product_out = $purchaseReturnDetail->qty;
        $stock->price = $purchaseReturnDetail->rate;
        $stock->amount = $purchaseReturnDetail->amount;
        $stock->tr_no = $purchaseReturnDetail->purchaseReturn->id;
        $stock->tr_from = "SaleReturn";
        $stock->lot_no = $purchaseReturnDetail->purchaseReturn->id;
        $stock->stocksable_id = $purchaseReturnDetail->id;
        $stock->stocksable_type = PurchaseReturnDetail::class;
        $stock->created_by = Auth()->user()->name;
        $stock->saveQuietly();
    }

    /**
     * Handle the PurchaseReturnDetail "updated" event.
     *
     * @param  \App\Models\PurchaseReturnDetail  $purchaseReturnDetail
     * @return void
     */
    public function updated(PurchaseReturnDetail $purchaseReturnDetail)
    {
        //
    }

    /**
     * Handle the PurchaseReturnDetail "deleted" event.
     *
     * @param  \App\Models\PurchaseReturnDetail  $purchaseReturnDetail
     * @return void
     */
    public function deleted(PurchaseReturnDetail $purchaseReturnDetail)
    {
        //
    }

    /**
     * Handle the PurchaseReturnDetail "restored" event.
     *
     * @param  \App\Models\PurchaseReturnDetail  $purchaseReturnDetail
     * @return void
     */
    public function restored(PurchaseReturnDetail $purchaseReturnDetail)
    {
        //
    }

    /**
     * Handle the PurchaseReturnDetail "force deleted" event.
     *
     * @param  \App\Models\PurchaseReturnDetail  $purchaseReturnDetail
     * @return void
     */
    public function forceDeleted(PurchaseReturnDetail $purchaseReturnDetail)
    {
        //
    }
}
