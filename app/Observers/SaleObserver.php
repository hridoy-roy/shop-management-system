<?php

namespace App\Observers;

use App\Models\Account;
use App\Models\Product;
use App\Models\Sale;
use App\Utility\Utility;

class SaleObserver
{
    /**
     * Handle the Sale "created" event.
     *
     * @param \App\Models\Sale $sale
     * @return void
     */
    public function created(Sale $sale)
    {
        if ($sale->type != 'Hold') {
            $account = new Account();
            $account->leaser_name = Utility::$leaser['Cash'];
            $account->date = now();
            $account->debit = $sale->amount;
            $account->transaction_num = $sale->sale_num;
            $account->transaction_name = Utility::$transaction['Sale'];
            $account->accountable_type = Sale::class;
            $account->created_by = \Auth::user()->name ?? 'seeder';
            $account->accountable_id = $sale->id;
            $account->saveQuietly();
        }
    }

    /**
     * Handle the Sale "updated" event.
     *
     * @param \App\Models\Sale $sale
     * @return void
     */
    public function updated(Sale $sale)
    {
//        if The sale is Hold Or Due, Account will not create
        if ($sale->type != 'Hold' && $sale->type != 'Due') {
            $account = new Account();
            $account->leaser_name = Utility::$leaser['Cash'];
            $account->date = now();
            $account->debit = $sale->amount;
            $account->transaction_num = $sale->sale_num;
            $account->transaction_name = Utility::$transaction['Sale'];
            $account->accountable_type = Sale::class;
            $account->accountable_id = $sale->id;
            $account->created_by = \Auth::user()->name ?? 'seeder';
            $account->saveQuietly();
        }
    }

    /**
     * Handle the Sale "deleted" event.
     *
     * @param \App\Models\Sale $sale
     * @return void
     */
    public function deleted(Sale $sale)
    {
        //
    }

    /**
     * Handle the Sale "restored" event.
     *
     * @param \App\Models\Sale $sale
     * @return void
     */
    public function restored(Sale $sale)
    {
        //
    }

    /**
     * Handle the Sale "force deleted" event.
     *
     * @param \App\Models\Sale $sale
     * @return void
     */
    public function forceDeleted(Sale $sale)
    {
        //
    }
}
