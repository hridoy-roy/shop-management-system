<?php

namespace App\Utility;

use phpDocumentor\Reflection\Types\Integer;

class Utility
{
    public static int $minStockValue = 5;
    public static int $newStatusDayValue = 10;
    const ACTIVE = "Active";
    const INACTIVE = "In Active";
    const PES = "Pes";
    const KG = "kg";
    const LITER = "liter";
    const CASH = 'Cash';
    const CASH_OPENING = 'Cash_Opening';
    const ITEM_OPENING = 'Item_Opening';
    const HOLD = 'Hold';
    const STOCK = 'Stock';
    const DUE = 'Due';
    const SALE = 'Sale';
    const SALE_RETURN = 'Sale_Return';
    const PURCHASE = 'Purchase';
    const PURCHASE_RETURN = 'Purchase_Return';
    const WITHDRAW = 'Withdraw';
    const WITHDRAW_HOLD = 'Withdraw_Hold';


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
        self::DUE => self::DUE,
    ];

    public static array $leaser = [
        self::CASH => self::CASH,
        self::STOCK => self::STOCK,
        self::WITHDRAW => self::WITHDRAW,
    ];

    public static array $transaction = [
        self::SALE => self::SALE,
        self::SALE_RETURN => self::SALE_RETURN,
        self::PURCHASE => self::PURCHASE,
        self::PURCHASE_RETURN => self::PURCHASE_RETURN,
    ];

    public static array $opening = [
        self::CASH_OPENING => self::CASH_OPENING,
        self::ITEM_OPENING => self::ITEM_OPENING,
    ];

    public static array $withdraw = [
        self::WITHDRAW => self::WITHDRAW,
        self::WITHDRAW_HOLD => self::WITHDRAW_HOLD,
    ];
}
