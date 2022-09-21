<?php

namespace App\Actions;

use App\Enums\LessonStatusEnum;
use App\Models\Lesson;

class UpdateCheckinStatusAction
{
    public function __invoke()
    {
        // do your task here...e.g.,
        Lesson::query()->whereDate('date', '<', today())
            ->update(['status' => LessonStatusEnum::HAPPENED->value]);
    }
}
