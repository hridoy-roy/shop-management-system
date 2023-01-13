<?php

namespace App\Observers;

use App\Models\Account;
use App\Models\Purchase;
use App\Utility\Utility;

class PurchaseObserver
{
    /**
     * Handle the Purchase "created" event.
     *
     * @param \App\Models\Purchase $purchase
     * @return void
     */
    public function created(Purchase $purchase)
    {
        $account = new Account();
        $account->leaser_name = Utility::$leaser['Cash'];
        $account->date = now();
        $account->credit = $purchase->amount;
        $account->transaction_num = $purchase->purchase_num;
        $account->transaction_name = Utility::$transaction['Purchase'];
        $account->accountable_type = Purchase::class;
        $account->created_by = \Auth::user()->name ?? 'seeder';
        $account->accountable_id = $purchase->id;
        $account->saveQuietly();

        $account = new Account();
        $account->leaser_name = Utility::$leaser['Stock'];
        $account->date = now();
        $account->debit = $purchase->amount;
        $account->transaction_num = $purchase->purchase_num;
        $account->transaction_name = Utility::$transaction['Purchase'];
        $account->accountable_type = Purchase::class;
        $account->created_by = \Auth::user()->name ?? 'seeder';
        $account->accountable_id = $purchase->id;
        $account->saveQuietly();
    }

    /**
     * Handle the Purchase "updated" event.
     *
     * @param \App\Models\Purchase $purchase
     * @return void
     */
    public function updated(Purchase $purchase)
    {
        //
    }

    /**
     * Handle the Purchase "deleted" event.
     *
     * @param \App\Models\Purchase $purchase
     * @return void
     */
    public function deleted(Purchase $purchase)
    {
        //
    }

    /**
     * Handle the Purchase "restored" event.
     *
     * @param \App\Models\Purchase $purchase
     * @return void
     */
    public function restored(Purchase $purchase)
    {
        //
    }

    /**
     * Handle the Purchase "force deleted" event.
     *
     * @param \App\Models\Purchase $purchase
     * @return void
     */
    public function forceDeleted(Purchase $purchase)
    {
        //
    }
}
