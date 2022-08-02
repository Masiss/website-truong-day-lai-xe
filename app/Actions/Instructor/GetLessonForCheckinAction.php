<?php

namespace App\Actions\Instructor;

use App\Enums\LessonStatusEnum;
use App\Models\Lesson;

class GetLessonForCheckinAction
{
    public static function handle(int $hour)
    {
        $lessons = Lesson::query()
            ->where('ins_id', auth('instructor')->user()->id)
            ->with('driver:id,name,email,phone_numbers')
            ->where('status', LessonStatusEnum::PENDING->value)
            ->where('date', date('Y/m/d'))
            ->orderBy('start_at');
        if ($hour >= 6 && $hour <= 12) {
            return $lessons->where('start_at', '<=', 12)
                ->paginate(15);
        }
        return $lessons->paginate(15);
    }

}
