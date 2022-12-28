<?php

namespace App\Observers;

use App\Models\Product;
use App\Models\Purchase;
use App\Models\PurchaseDetail;
use App\Models\Stock;

class PurchaseDetailObserver
{
    /**
     * Handle the PurchaseDetail "created" event.
     *
     * @param  \App\Models\PurchaseDetail  $purchaseDetail
     * @return void
     */
    public function created(PurchaseDetail $purchaseDetail)
    {
        $product = Product::find($purchaseDetail->product_id);
        $product->price = $purchaseDetail->rate;
        $product->saveQuietly();

        $stock = new Stock();
        $stock->product_id = $purchaseDetail->product_id;
        $stock->product_in = $purchaseDetail->qty;
        $stock->price = $purchaseDetail->rate;
        $stock->amount = $purchaseDetail->amount;
        $stock->tr_no = $purchaseDetail->purchase->id;
        $stock->tr_from = "Purchase";
        $stock->lot_no = $purchaseDetail->purchase->id;
        $stock->stocksable_id = $purchaseDetail->id;
        $stock->stocksable_type = PurchaseDetail::class;
        $stock->created_by = Auth()->user()->name ?? 'seed';
        $stock->saveQuietly();
    }

    /**
     * Handle the PurchaseDetail "updated" event.
     *
     * @param  \App\Models\PurchaseDetail  $purchaseDetail
     * @return void
     */
    public function updated(PurchaseDetail $purchaseDetail)
    {
        //
    }

    /**
     * Handle the PurchaseDetail "deleted" event.
     *
     * @param  \App\Models\PurchaseDetail  $purchaseDetail
     * @return void
     */
    public function deleted(PurchaseDetail $purchaseDetail)
    {
        //
    }

    /**
     * Handle the PurchaseDetail "restored" event.
     *
     * @param  \App\Models\PurchaseDetail  $purchaseDetail
     * @return void
     */
    public function restored(PurchaseDetail $purchaseDetail)
    {
        //
    }

    /**
     * Handle the PurchaseDetail "force deleted" event.
     *
     * @param  \App\Models\PurchaseDetail  $purchaseDetail
     * @return void
     */
    public function forceDeleted(PurchaseDetail $purchaseDetail)
    {
        //
    }
}
