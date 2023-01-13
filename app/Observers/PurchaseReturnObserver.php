<?php

namespace App\Observers;

use App\Models\Account;
use App\Models\PurchaseReturn;
use App\Utility\Utility;

class PurchaseReturnObserver
{
    /**
     * Handle the PurchaseReturn "created" event.
     *
     * @param  \App\Models\PurchaseReturn  $purchaseReturn
     * @return void
     */
    public function created(PurchaseReturn $purchaseReturn)
    {
        $account = new Account();
        $account->leaser_name = Utility::$leaser['Cash'];
        $account->date = now();
        $account->debit= $purchaseReturn->amount;
        $account->transaction_num = $purchaseReturn->purchase_return_num;
        $account->transaction_name = Utility::$transaction['Purchase_Return'];
        $account->accountable_type = PurchaseReturn::class;
        $account->created_by = \Auth::user()->name ?? 'seeder';
        $account->accountable_id = $purchaseReturn->id;
        $account->saveQuietly();

        $account = new Account();
        $account->leaser_name = Utility::$leaser['Stock'];
        $account->date = now();
        $account->credit = $purchaseReturn->amount;
        $account->transaction_num = $purchaseReturn->purchase_return_num;
        $account->transaction_name = Utility::$transaction['Purchase_Return'];
        $account->accountable_type = PurchaseReturn::class;
        $account->created_by = \Auth::user()->name ?? 'seeder';
        $account->accountable_id = $purchaseReturn->id;
        $account->saveQuietly();
    }

    /**
     * Handle the PurchaseReturn "updated" event.
     *
     * @param  \App\Models\PurchaseReturn  $purchaseReturn
     * @return void
     */
    public function updated(PurchaseReturn $purchaseReturn)
    {
        //
    }

    /**
     * Handle the PurchaseReturn "deleted" event.
     *
     * @param  \App\Models\PurchaseReturn  $purchaseReturn
     * @return void
     */
    public function deleted(PurchaseReturn $purchaseReturn)
    {
        //
    }

    /**
     * Handle the PurchaseReturn "restored" event.
     *
     * @param  \App\Models\PurchaseReturn  $purchaseReturn
     * @return void
     */
    public function restored(PurchaseReturn $purchaseReturn)
    {
        //
    }

    /**
     * Handle the PurchaseReturn "force deleted" event.
     *
     * @param  \App\Models\PurchaseReturn  $purchaseReturn
     * @return void
     */
    public function forceDeleted(PurchaseReturn $purchaseReturn)
    {
        //
    }
}
