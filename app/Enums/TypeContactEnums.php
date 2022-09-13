<?php

namespace App\Enums;

enum TypeContactEnums: int
{
    case CONSULT = 0;
    case ASKING = 1;
    case REPLIED = 2;

    public static function toVNese($value)
    {
        switch ($value) {
            case (self::CONSULT->value):
                return 'Tư vấn';
            case(self::ASKING->value):
                return 'Hỏi đáp';
            case(self::REPLIED->value):
                return 'Đã phản hồi';
        }
        return null;
    }

    public static function isReplied($VNese)
    {
        switch ($VNese) {
            case(self::toVNese(self::REPLIED->value)):
                return true;
            default:
                return false;
        }
    }
}
