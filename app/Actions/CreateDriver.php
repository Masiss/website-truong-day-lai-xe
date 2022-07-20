<?php

namespace App\Actions;

use App\Enums\LessonStatusEnum;
use App\Models\Course;
use App\Models\Instructor;
use App\Models\Lesson;
use Illuminate\Support\Facades\DB;

class CreateDriver
{
    private const PricePerDay = 200000;
    private const PriceFullCourse = 3500000;

    public static function createCourse($request)
    {
        $request->days_of_week = explode(',', $request->days_of_week);
        if ($request->is_full) {
            $request->merge(['price_per_day' => null]);
            $request->merge(['price' => self::PriceFullCourse]);
        } else {
            $request->merge(['price_per_day' => $request->lesson * self::PricePerDay]);
            $request->merge(['price' => null]);
        }
        $course_id = Course::query()->create([
            'days_of_week' => json_encode($request->days_of_week),
            'price' => $request->price,
            'price_per_day' => $request->price_per_day,
        ])->id;
        return $course_id;
    }


    private const MorningStart = 7;
    private const EveningStart = 14;
    private const HalfShift = 2;
    private const FullShift = 4;
    private const TotalHour = 40;

    public static function AddLessons($request, $driver_id)
    {
        $request->lesson = self::TotalHour / $request->last;
        if ($request->is_full) {
            $lessons = ActionForLessons::getDates(count($request->days_of_week), $request->days_of_week);

        } else {
            $lessons = ActionForLessons::getDates($request->lesson, $request->days_of_week);
        }
        //get instructor not exist in Lessons or have less day in Lessons
        $sub = DB::table('lessons')
            ->select('ins_id', DB::raw('count(ins_id) as less_ins'))
            ->groupBy('ins_id')
            ->orderBy('less_ins', 'ASC')
            ->first();
        $ins_id = Instructor::query()->whereNotIn('id', function ($query) {
            $query->select('ins_id')->from('lessons');
        })->orWhere('id', '=', $sub->ins_id)
            ->first()->id;


        if ($request->shift === 'AM') {
            $start_at = self::MorningStart;
        } elseif ($request->shift === 'PM') {
            $start_at = self::EveningStart;
        }
        //add lesson for per date chose
        foreach ($lessons as $date) {
            Lesson::query()->create([
                'driver_id' => $driver_id,
                'ins_id' => $ins_id,
                'last' => $request->last,
                'start_at' => $start_at,
                'date' => $date,
                'status' => LessonStatusEnum::PENDING->value,

            ]);
        }
    }
}
