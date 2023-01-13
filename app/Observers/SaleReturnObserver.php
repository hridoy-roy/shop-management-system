<?php

namespace App\Observers;

use App\Models\Account;
use App\Models\SaleReturn;
use App\Utility\Utility;

class SaleReturnObserver
{
    /**
     * Handle the SaleReturn "created" event.
     *
     * @param  \App\Models\SaleReturn  $saleReturn
     * @return void
     */
    public function created(SaleReturn $saleReturn)
    {
        $account = new Account();
        $account->leaser_name = Utility::$leaser['Cash'];
        $account->date = now();
        $account->credit = $saleReturn->amount;
        $account->transaction_num = $saleReturn->sale_return_num;
        $account->transaction_name = Utility::$transaction['Sale_Return'];
        $account->accountable_type = SaleReturn::class;
        $account->created_by = \Auth::user()->name ?? 'seeder';
        $account->accountable_id = $saleReturn->id;
        $account->saveQuietly();

        $account = new Account();
        $account->leaser_name = Utility::$leaser['Stock'];
        $account->date = now();
        $account->debit = $saleReturn->amount;
        $account->transaction_num = $saleReturn->sale_return_num;
        $account->transaction_name = Utility::$transaction['Sale_Return'];
        $account->accountable_type = SaleReturn::class;
        $account->created_by = \Auth::user()->name ?? 'seeder';
        $account->accountable_id = $saleReturn->id;
        $account->saveQuietly();
    }

    /**
     * Handle the SaleReturn "updated" event.
     *
     * @param  \App\Models\SaleReturn  $saleReturn
     * @return void
     */
    public function updated(SaleReturn $saleReturn)
    {
        //
    }

    /**
     * Handle the SaleReturn "deleted" event.
     *
     * @param  \App\Models\SaleReturn  $saleReturn
     * @return void
     */
    public function deleted(SaleReturn $saleReturn)
    {
        //
    }

    /**
     * Handle the SaleReturn "restored" event.
     *
     * @param  \App\Models\SaleReturn  $saleReturn
     * @return void
     */
    public function restored(SaleReturn $saleReturn)
    {
        //
    }

    /**
     * Handle the SaleReturn "force deleted" event.
     *
     * @param  \App\Models\SaleReturn  $saleReturn
     * @return void
     */
    public function forceDeleted(SaleReturn $saleReturn)
    {
        //
    }
}
