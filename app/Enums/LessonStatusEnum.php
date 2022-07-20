<?php

namespace App\Enums;

enum LessonStatusEnum: int
{
    case PENDING = 0;
    case HAPPENED = 1;
    case CANCELED = 2;

    public static function StatusInVNese($value)
    {
        switch ($value) {
            case (self::PENDING->value):
                return "Chưa bắt đầu";
            case(self::HAPPENED->value):
                return "Đã diễn ra";
            case(self::CANCELED->value):
                return "Đã hủy";

        }
    }
}
