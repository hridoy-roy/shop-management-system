<?php

namespace App\Treat;

trait SaleId
{
    public function SaleId(): int|string|null
    {
        $saleId = \App\Models\Sale::latest()->select('sale_num')->first()->sale_num ?? null;
        $saleId ? $saleId += 1 : $saleId = "0000001";

        return sprintf('%07s', $saleId);
    }
}
