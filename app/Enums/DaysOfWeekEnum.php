<?php

namespace App\Enums;

enum DaysOfWeekEnum: string
{
    case Mon = "Thứ 2";
    case Tue = "Thứ 3";
    case Wed = "Thứ 4";
    case Thu = "Thứ 5";
    case Fri = "Thứ 6";
    case Sat = "Thứ 7";

    public static function getKey($value)
    {
        foreach (self::cases() as $key) {
            if ($key->name === $value) {
                return $key->name;
            }
        }
    }

    public static function getValueByKey($value)
    {
        foreach (self::cases() as $key) {
            if ($key->name === $value) {
                return $key->value;
            }
        }
    }

}
