<?php

namespace App\Utility;

class Utility
{
    const ACTIVE = "Active";
    const INACTIVE = "In Active";
    const PES = "Pes";
    const KG = "kg";
    const LITER = "liter";
    const CHECKED = 'Cash';
    const HOLD = 'Hold';


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
        self::CHECKED => self::CHECKED,
        self::HOLD => self::HOLD,
    ];
}
