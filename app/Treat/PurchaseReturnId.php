<?php

namespace App\Treat;

use App\Models\PurchaseReturn;


trait PurchaseReturnId
{
    public function PurchaseReturnId(): int|string|null
    {
        $purchaseReturnId = PurchaseReturn::latest()->select('purchase_return_num')->first()->purchase_return_num ?? null;
        $purchaseReturnId = str_replace("PR",'',$purchaseReturnId);
        $purchaseReturnId ? $purchaseReturnId += 1 : $purchaseReturnId = "000001";

        return "PR".sprintf('%07s', $purchaseReturnId);
    }
}
