<?php

namespace App\Enums;

enum LessonStatusEnum: int
{
    case PENDING = 0;
    case HAPPENED = 1;
    case CANCELED = 2;

    public static function VNeseToValue($VNese)
    {
        switch ($VNese) {
            case(self::StatusInVNese(self::PENDING->value)):
                return self::PENDING->value;
            case(self::StatusInVNese(self::HAPPENED->value)):
                return self::HAPPENED->value;
            case(self::StatusInVNese(self::CANCELED->value)):
                return self::CANCELED->value;

        }
    }

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

    public static function CanBeCancelled($status)
    {
        switch ($status) {
            case(self::StatusInVNese(self::PENDING->value)):
                return true;
            default:
                return false;
        }
    }

    public static function CanBeRating($status)
    {
        switch ($status) {
            case(self::StatusInVNese(self::HAPPENED->value)):
                return true;
            default:
                return false;
        }
    }

    public static function CanBeUpdated($status)
    {
        switch ($status) {
            case(self::StatusInVNese(self::PENDING->value)):
            case(self::StatusInVNese(self::HAPPENED->value)):
                return true;
            default:
                return false;
        }
    }
}
