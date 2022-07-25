<?php

namespace App\Enums;

enum SalaryStatusEnum: int
{
    case PENDING = 0;
    case APPROVED = 1;

    public static function toVNese($value)
    {
        switch ($value) {
            case (self::PENDING->value):
                return "Đang đợi";
            case (self::APPROVED->value):
                return "Đã duyệt";
        }
    }

    public static function checkApproved($value)
    {
        switch ($value) {
            case(self::APPROVED->value):
            case(self::APPROVED->name):
            case("Đã duyệt"):
                return true;
            case (self::PENDING->value):
            case (self::PENDING->name):
            case("Đang đợi"):
                return false;
        }
    }
}
