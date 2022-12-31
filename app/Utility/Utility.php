<?php

namespace App\Utility;

use phpDocumentor\Reflection\Types\Integer;

class Utility
{
    const ACTIVE = "Active";
    const INACTIVE = "In Active";
    const PES = "Pes";
    const KG = "kg";
    const LITER = "liter";
    const CASH = 'Cash';
    const HOLD = 'Hold';
    const STOCK = 'Stock';
    const SALE = 'Sale';
    const SALE_RETURN = 'Sale_Return';
    const PURCHASE = 'Purchase';
    const PURCHASE_RETURN = 'Purchase_Return';
    public static int $minStockValue= 5;


    public static array $status = [
        1 => self::ACTIVE,
        0 => self::INACTIVE,
    ];

    public static array $units = [
        self::PES => self::PES,
        self::KG => self::KG,
        self::LITER => self::LITER,
    ];

    public static array $type = [
        self::CASH => self::CASH,
        self::HOLD => self::HOLD,
    ];

    public static array $leaser = [
        self::CASH => self::CASH,
        self::STOCK => self::STOCK,
    ];

    public static array $transaction = [
        self::SALE => self::SALE,
        self::SALE_RETURN => self::SALE_RETURN,
        self::PURCHASE => self::PURCHASE,
        self::PURCHASE_RETURN => self::PURCHASE_RETURN,
    ];
}
