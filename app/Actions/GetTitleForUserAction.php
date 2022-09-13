<?php

namespace App\Actions;

use App\Enums\LevelEnum;

class GetTitleForUserAction
{
    public static function handle()
    {
        if (auth('driver')->check()) {
            return 'Học viên';
        } elseif (auth('instructor')->check()) {
            switch (auth('instructor')->user()->level) {
                case (LevelEnum::ADMIN->name):
                    return 'Admin';
                case (LevelEnum::INSTRUCTOR->name):
                    return 'Giáo viên';
            }
        } else {
            return "";
        }
    }

}
