<?php

namespace App\Actions;

use App\Actions\Instructor\GetInstructorForLessonsAction;
use App\Actions\Lesson\GetDatesAction;
use App\Enums\LessonStatusEnum;
use App\Models\Course;
use App\Models\Lesson;

class CreateDriverAction
{
    private const PricePerDay = 200000;
    private const PriceFullCourse = 3500000;
    private const TotalHour = 40;

    public static function createCourse(array $courseArr, bool $is_full,$last)
    {
        $courseArr['lesson'] = self::TotalHour / $last;
        if ($is_full) {
            $courseArr['price_per_day'] = null;
            $courseArr['price'] = self::PriceFullCourse;
        } else {
            $courseArr['price_per_day'] = $courseArr['lesson'] * self::PricePerDay;
            $courseArr['price'] = null;
        }

        $course_id = Course::query()->create($courseArr)
            ->id;
        return $course_id;
    }


    private const MorningStart = 7;
    private const EveningStart = 14;
    private const HalfShift = 2;
    private const FullShift = 4;

    public static function AddLessons(array $lessonArr, bool $is_full)
    {
        $lessonArr['status'] = LessonStatusEnum::PENDING->value;

        if ($is_full) {
            $dates = GetDatesAction::handle($lessonArr['lesson'], $lessonArr['days_of_week']);
        } else {
            $dates = GetDatesAction::handle(count($lessonArr['days_of_week']), $lessonArr['days_of_week']);
        }
        //get instructor not exist in Lessons or have less day in Lessons
        $lessonArr['ins_id'] = GetInstructorForLessonsAction::handle();
        if ($lessonArr['shift'] === 'AM') {
            $lessonArr['start_at'] = self::MorningStart;
        } elseif ($lessonArr['shift'] === 'PM') {
            $lessonArr['start_at'] = self::EveningStart;
        }
        //add lesson for per date chose
        foreach ($dates as $date) {
            $lessonArr['date'] = $date;
            Lesson::query()->create($lessonArr);
        }
    }
}
