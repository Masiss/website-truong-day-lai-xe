<?php

namespace App\Actions;

use App\Models\Lesson;

class ActionForLessons
{
    public static function getDates($limit, $dow)
    {
        $date = now();
        $schedule = array();
        while (count($schedule) < $limit) {
            $date->setISODate($date->format('o'), $date->format('W') + 1);
            // set object to Monday on next week
            $periods = new \DatePeriod($date, new \DateInterval('P1D'), 5);
            // get all 1day periods from Monday to +6 days
            $days = iterator_to_array($periods);
            // convert DatePeriod object to array
            foreach ($days as $day) {
                if (count($schedule) < $limit) {
                    if (in_array($day->format('D'), $dow, true)) {
                        $schedule[] = $day->format('Y/m/d');

                    }
                } else {
                    return $schedule;
                }

            }
            $date->setISODate($date->format('o'), $date->format('W') + 1);
        }
        return $schedule;

    }

    public static function filterLessons($choose)
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
