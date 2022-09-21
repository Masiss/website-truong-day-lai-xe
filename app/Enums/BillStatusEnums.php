<?php

namespace App\Enums;

enum BillStatusEnums: int
{
    case PENDING = 0;
    case CONFIRMED = 1;

    public static function toVNese($value)
    {
        switch ($value) {
            case(self::PENDING->value):
                return 'Chưa thanh toán';
            case(self::CONFIRMED->value):
                return 'Đã thanh toán';
        }
    }
}
