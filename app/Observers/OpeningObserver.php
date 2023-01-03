<?php

namespace App\Observers;

use App\Models\Account;
use App\Models\Opening;
use App\Models\Stock;
use App\Utility\Utility;

class OpeningObserver
{
    /**
     * Handle the Opening "created" event.
     *
     * @param  \App\Models\Opening  $opening
     * @return void
     */
    public function created(Opening $opening)
    {
        if ($opening->type === 'Cash_Opening'){
            $account = new Account();
            $account->leaser_name = Utility::$leaser['Cash'];
            $account->date = now();
            $account->debit = $opening->price;
            $account->transaction_num = $opening->id;
            $account->transaction_name = Utility::$opening['Cash_Opening'];
            $account->accountable_type = Opening::class;
            $account->created_by = \Auth::user()->name ?? 'seeder';
            $account->accountable_id = $opening->id;
            $account->saveQuietly();
        }elseif($opening->type === 'Item_Opening'){
            $stock = new Stock();
            $stock->product_id = $opening->product_id;
            $stock->product_in = $opening->qty;
            $stock->price = $opening->price;
            $stock->amount = $opening->price * $opening->qty;
            $stock->tr_no = $opening->id;
            $stock->tr_from = "Item_Opening";
            $stock->lot_no = $opening->id;
            $stock->stocksable_id = $opening->id;
            $stock->stocksable_type = Opening::class;
            $stock->created_by = Auth()->user()->name ?? 'seeder';
            $stock->saveQuietly();
        }
    }

    /**
     * Handle the Opening "updated" event.
     *
     * @param  \App\Models\Opening  $opening
     * @return void
     */
    public function updated(Opening $opening)
    {
        //
    }

    /**
     * Handle the Opening "deleted" event.
     *
     * @param  \App\Models\Opening  $opening
     * @return void
     */
    public function deleted(Opening $opening)
    {
        //
    }

    /**
     * Handle the Opening "restored" event.
     *
     * @param  \App\Models\Opening  $opening
     * @return void
     */
    public function restored(Opening $opening)
    {
        //
    }

    /**
     * Handle the Opening "force deleted" event.
     *
     * @param  \App\Models\Opening  $opening
     * @return void
     */
    public function forceDeleted(Opening $opening)
    {
        //
    }
}
