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

    public static function TrueFalse($value)
    {
        $value=self::VNeseToValue($value);
        switch ($value) {
            case((self::Male->value)):
                return false;
            case(self::Female->value):
                return true;
        }
    }

    public static function VNeseToValue($Vnese)
    {
        switch ($Vnese) {
            case ("Nam"):
                return self::Male->value;
            case("Nữ"):
                return self::Female->value;
        }
    }
}
