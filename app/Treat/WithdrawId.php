<?php

namespace App\Treat;

trait WithdrawId
{
    public function withdrawId(): int|string|null
    {
        $withdrewId = \App\Models\Withdraw::latest()->select('withdraw_num')->first()->withdraw_num ?? null;
        $withdrewId = str_replace("W",'',$withdrewId);
        $withdrewId ? $withdrewId += 1 : $withdrewId = "0000001";

        return sprintf('%07s', $withdrewId);
    }
}
