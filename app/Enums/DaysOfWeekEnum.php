<?php

namespace App\Enums;

enum DaysOfWeekEnum: int
{
    case Mon = 1;
    case Tue = 2;
    case Wed = 3;
    case Thu = 4;
    case Fri = 5;
    case Sat = 6;

    public static function getKey($value)
    {
        foreach (self::cases() as $key) {
            if ($key->name === $value) {
                return (int)$key->name;
            }
        }
    }
}
