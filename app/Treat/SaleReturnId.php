<?php

namespace App\Treat;

trait SaleReturnId
{
    public function SaleReturnId(): int|string|null
    {
        $SaleReturnId = \App\Models\SaleReturn::latest()->select('sale_return_num')->first()->sale_return_num ?? null;
        $SaleReturnId ? $SaleReturnId += 1 : $SaleReturnId = "0000001";

        return sprintf('%06s', $SaleReturnId);
    }
}
