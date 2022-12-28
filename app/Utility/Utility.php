<?php

namespace App\Utility;

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
    const PURCHASE = 'Purchase';


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
        self::PURCHASE => self::PURCHASE,
    ];
}
