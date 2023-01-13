<?php

namespace App\Observers;

use App\Models\Account;
use App\Models\Product;
use App\Models\Sale;
use App\Models\SaleDetail;
use App\Models\Stock;
use App\Utility\Utility;

class SaleDetailObserver
{
    /**
     * Handle the SaleDetail "created" event.
     *
     * @param \App\Models\SaleDetail $saleDetail
     * @return void
     */
    public function created(SaleDetail $saleDetail)
    {
        //        This is for Normal Hold Sale For Stock
        if ($saleDetail->sale->type != 'Hold') {
            $stock = new Stock();
            $stock->product_id = $saleDetail->product_id;
            $stock->product_out = $saleDetail->qty;
            $stock->price = $saleDetail->rate;
            $stock->amount = $saleDetail->amount;
            $stock->tr_no = $saleDetail->sale->sale_num;
            $stock->tr_from = "Sale";
            $stock->lot_no = $saleDetail->sale->id;
            $stock->stocksable_id = $saleDetail->id;
            $stock->stocksable_type = SaleDetail::class;
            $stock->created_by = Auth()->user()->name ?? 'seeder';
            $stock->saveQuietly();
        }

        //        This is for Normal Sale For Account
        $account = Account::where([
            ['leaser_name', '=', Utility::$leaser['Stock']],
            ['transaction_num', '=', $saleDetail->sale->sale_num],
            ['accountable_type', '=', Sale::class],
            ['accountable_id', '=', $saleDetail->sale->id],
        ])->first() ?? false;
        if ($account) {
            $product = Product::findOrfail($saleDetail->product_id);
            $amount = $product->price * $saleDetail->qty;
            $account->leaser_name = Utility::$leaser['Stock'];
            $account->date = now();
            $account->credit += $amount;
            $account->transaction_num = $saleDetail->sale->sale_num;
            $account->transaction_name = Utility::$transaction['Sale'];
            $account->accountable_type = Sale::class;
            $account->accountable_id = $saleDetail->sale->id;
            $account->created_by = \Auth::user()->name ?? 'seeder';
            $account->saveQuietly();
        } else {
            $product = Product::findOrfail($saleDetail->product_id);
            $amount = $product->price * $saleDetail->qty;
            $account = new Account();
            $account->leaser_name = Utility::$leaser['Stock'];
            $account->date = now();
            $account->credit = $amount;
            $account->transaction_num = $saleDetail->sale->sale_num;
            $account->transaction_name = Utility::$transaction['Sale'];
            $account->accountable_type = Sale::class;
            $account->accountable_id = $saleDetail->sale->id;
            $account->created_by = \Auth::user()->name ?? 'seeder';
            $account->saveQuietly();
        }
    }

    /**
     * Handle the SaleDetail "updated" event.
     *
     * @param \App\Models\SaleDetail $saleDetail
     * @return void
     */
    public function updated(SaleDetail $saleDetail)
    {
        //
    }

    /**
     * Handle the SaleDetail "deleted" event.
     *
     * @param \App\Models\SaleDetail $saleDetail
     * @return void
     */
    public function deleted(SaleDetail $saleDetail)
    {
        //
    }

    /**
     * Handle the SaleDetail "restored" event.
     *
     * @param \App\Models\SaleDetail $saleDetail
     * @return void
     */
    public function restored(SaleDetail $saleDetail)
    {
        //
    }

    /**
     * Handle the SaleDetail "force deleted" event.
     *
     * @param \App\Models\SaleDetail $saleDetail
     * @return void
     */
    public function forceDeleted(SaleDetail $saleDetail)
    {
        //
    }
}
