<?php

namespace App\Enums;

enum LessonStatusEnum: int
{
    case PENDING = 0;
    case HAPPENING = 1;
    case HAPPENED = 2;
    case CANCELED = 3;
}
