<?php

namespace App\Treat;

trait SaleId
{
    public function SaleId(): int|string|null
    {
        $saleId = \App\Models\Sale::latest()->select('sale_num')->first()->sale_num ?? null;
        $saleId = str_replace("S",'',$saleId);
        $saleId ? $saleId += 1 : $saleId = "0000001";

        return "S".sprintf('%07s', $saleId);
    }
}
