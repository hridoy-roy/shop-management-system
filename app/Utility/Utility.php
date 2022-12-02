<?php

namespace App\Utility;

class Utility
{
    const ACTIVE = "Action";
    const INACTIVE = "In Action";
    const PES = "pes";
    const KG = "kg";
    const LITER = "liter";


    public static array $status = [
        1 => self::ACTIVE,
        0 => self::INACTIVE,
    ];

    public static array $units = [
        self::PES => self::PES,
        self::PES => self::PES,
        self::KG => self::KG,
        self::LITER => self::LITER,
    ];
}
