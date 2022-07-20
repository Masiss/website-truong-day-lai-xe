<?php

namespace App\Enums;

enum GenderNameEnum: int
{
    case Male = 0;
    case Female = 1;

    public static function toVNese($value)
    {
        if ($value == self::Male->value) {
            return "Nam";
        } elseif ($value == self::Female->value) {
            return "Nữ";
        }
    }
}
