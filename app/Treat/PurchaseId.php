<?php

namespace App\Treat;

use App\Models\Purchase;


trait PurchaseId
{
    public function purchaseId(): int|string|null
    {
        $purchaseId = Purchase::latest()->select('purchase_num')->first()->purchase_num ?? null;
        $purchaseId ? $purchaseId += 1 : $purchaseId = "000001";

        return sprintf('%06s', $purchaseId);
    }
}
