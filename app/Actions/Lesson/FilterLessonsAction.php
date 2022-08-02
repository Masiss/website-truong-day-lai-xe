<?php

namespace App\Actions\Lesson;

use App\Models\Lesson;

class FilterLessonsAction
{
    public static function handle(string $choose = null)
    {
        $query = Lesson::query()->with('instructor')->with('driver');
        switch ($choose) {
            default:
                return $query->paginate(15);
            case("this_week"):
                $week_start = date("Y/m/d", strtotime('last Sunday', time()));
                $week_end = date("Y/m/d", strtotime('next Sunday', time()));
                return $query->whereBetween('date', [$week_start, $week_end])
                    ->paginate(15);
            case("this_month"):
                $month_start = date("Y/m/d", strtotime('first day of this month', time()));
                $month_end = date("Y/m/d", strtotime('last day of this month', time()));
                return $query->whereBetween('date', [$month_start, $month_end])
                    ->paginate(15);
            case("today"):
                return $query->where('date', date("Y/m/d"))
                    ->paginate(15);
        }
    }
}
