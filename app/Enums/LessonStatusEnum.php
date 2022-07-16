<?php

namespace App\Enums;

enum LessonStatusEnum: int
{
    case PENDING = 0;
    case HAPPENED = 1;
    case CANCELED = 2;
}
