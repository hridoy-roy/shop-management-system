<?php

namespace App\Observers;

use App\Models\Account;
use App\Models\Withdraw;
use App\Utility\Utility;

class WithdrawObserver
{
    /**
     * Handle the Withdrawal "created" event.
     *
     * @param \App\Models\Withdraw $withdraw
     * @return void
     */
    public function created(Withdraw $withdraw)
    {
        if ($withdraw->type != 'Withdraw_Hold') {
            $account = new Account();
            $account->leaser_name = Utility::$leaser['Cash'];
            $account->date = now('Asia/Dhaka');
            $account->credit = $withdraw->amount;
            $account->transaction_num = $withdraw->withdraw_num;
            $account->transaction_name = Utility::$withdraw['Withdraw'];
            $account->accountable_type = Withdraw::class;
            $account->accountable_id = $withdraw->id;
            $account->created_by = \Auth::user()->name ?? 'seeder';
            $account->saveQuietly();
        }
    }

    /**
     * Handle the Withdrawal "updated" event.
     *
     * @param \App\Models\Withdraw $withdraw
     * @return void
     */
    public function updated(Withdraw $withdraw)
    {


        if ($withdraw->type != 'Withdraw_Hold') {
            $account = Account::where([
                ['leaser_name', '=', Utility::$leaser['Cash']],
                ['transaction_num', '=', $withdraw->withdraw_num],
                ['transaction_name', '=', Utility::$withdraw['Withdraw']],
                ['accountable_type', '=', Withdraw::class],
                ['accountable_id', '=', $withdraw->id],
            ])->first();

            $account->leaser_name = Utility::$leaser['Cash'];
            $account->date = now('Asia/Dhaka');
            $account->credit = $withdraw->amount;
            $account->transaction_num = $withdraw->withdraw_num;
            $account->transaction_name = Utility::$withdraw['Withdraw'];
            $account->accountable_type = Withdraw::class;
            $account->accountable_id = $withdraw->id;
            $account->created_by = \Auth::user()->name ?? 'seeder';
            $account->saveQuietly();
        }else{
            $account = Account::where([
                ['leaser_name', '=', Utility::$leaser['Cash']],
                ['transaction_num', '=', $withdraw->withdraw_num],
                ['transaction_name', '=', Utility::$withdraw['Withdraw']],
                ['accountable_type', '=', Withdraw::class],
                ['accountable_id', '=', $withdraw->id],
            ])->first();
            if ($account)
                $account->deleteQuietly();
        }
    }

    /**
     * Handle the Withdrawal "deleted" event.
     *
     * @param \App\Models\Withdraw $withdraw
     * @return void
     */
    public function deleted(Withdraw $withdraw)
    {
        if ($withdraw->type != 'Withdraw_Hold') {
            $account = Account::where([
                ['leaser_name', '=', Utility::$leaser['Cash']],
                ['transaction_num', '=', $withdraw->withdraw_num],
                ['transaction_name', '=', Utility::$withdraw['Withdraw']],
                ['accountable_type', '=', Withdraw::class],
                ['accountable_id', '=', $withdraw->id],
            ])->first();
            if ($account)
                $account->deleteQuietly();
        }
    }

    /**
     * Handle the Withdrawal "restored" event.
     *
     * @param \App\Models\Withdraw $withdraw
     * @return void
     */
    public function restored(Withdraw $withdraw)
    {
        //
    }

    /**
     * Handle the Withdrawal "force deleted" event.
     *
     * @param \App\Models\Withdraw $withdraw
     * @return void
     */
    public function forceDeleted(Withdraw $withdraw)
    {
        //
    }
}
