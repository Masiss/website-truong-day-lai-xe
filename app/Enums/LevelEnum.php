<?php

namespace App\Enums;

enum LevelEnum: int
{
    case ADMIN = 0;
    case INSTRUCTOR = 1;

    public static function isAdmin()
    {
        $level = auth('instructor')->user()->level;
        switch ($level) {
            case self::ADMIN->name:
                return true;
            default:
                return false;
        }
    }

}
