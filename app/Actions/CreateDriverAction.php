<?php

namespace App\Actions;

use App\Actions\Instructor\GetInstructorForLessonsAction;
use App\Actions\Lesson\GetDatesAction;
use App\Enums\BillStatusEnums;
use App\Enums\LessonStatusEnum;
use App\Models\Bill;
use App\Models\Config;
use App\Models\Course;
use App\Models\Lesson;

class CreateDriverAction
{


    public static function AddLessons(array $lessonArr, bool $is_full)
    {
        $lessonArr['status'] = LessonStatusEnum::PENDING->value;

        if ($is_full) {
            $total_lesson = $lessonArr['last'] === 4 ?
                Config::query()->where('key', 'full_course_4_hours')->first()->value :
                Config::query()->where('key', 'full_course_2_hours')->first()->value;
            $dates = GetDatesAction::handle($total_lesson, $lessonArr['days_of_week']);
        } else {
            $total_lesson = count($lessonArr['days_of_week']);
            $dates = GetDatesAction::handle($total_lesson, $lessonArr['days_of_week']);
        }
        //get instructor not exist in Lessons or have less day in Lessons
        $lessonArr['ins_id'] = GetInstructorForLessonsAction::handle();
        if ($lessonArr['shift'] === 'AM') {
            $lessonArr['start_at'] = Config::query()->where('key', 'morning_start')->first()->value;
        } elseif ($lessonArr['shift'] === 'PM') {
            $lessonArr['start_at'] = Config::query()->where('key', 'evening_start')->first()->value;

        }
        //add lesson for per date chose
        foreach ($dates as $date) {
            $lessonArr['date'] = $date;
            Lesson::query()->create($lessonArr);
        }
        return $total_lesson;
    }

    public static function createBill($driver_id, $is_full, $course_id, $total_lesson)
    {
        $bill = [];
        $bill['driver_id'] = $driver_id;
        $bill['course_id'] = $course_id;
        $course = Course::query()->where('id', $course_id)->first();
        if ($is_full) {
            $bill['tuition'] = $course->price;
        } else {
            $bill['tuition'] = $course->price_per_day * $total_lesson;
        }
        $bill['status'] = BillStatusEnums::PENDING->value;
        Bill::query()->create($bill);
    }
}
