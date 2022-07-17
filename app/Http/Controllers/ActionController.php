<?php

namespace App\Http\Controllers;

use App\Enums\LessonStatusEnum;
use App\Models\Course;
use App\Models\Instructor;
use App\Models\Lesson;
use App\Models\MonthSalary;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;

class ActionController extends Controller
{
    private const PricePerDay = 200000;
    private const PriceFullCourse = 3500000;

    public static function createCourse($request)
    {
        $request->days_of_week = explode(',', $request->days_of_week);
        if ($request->is_full) {
            $lessons = ActionController::GetDatesForLessons($request->lesson, $request->days_of_week);
            $request->merge(['price_per_day' => null]);
            $request->merge(['price' => self::PriceFullCourse]);
        } else {
            $lessons = ActionController::GetDatesForLessons(count($request->days_of_week), $request->days_of_week);
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

    public static function GetDatesForLessons($limit, $dow)
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

    private const MorningStart = 7;
    private const EveningStart = 14;
    private const HalfShift = 2;
    private const FullShift = 4;
    private const TotalHour = 40;

    public static function AddLessons($request, $driver_id)
    {
        $request->lesson = self::TotalHour / $request->last;
        if ($request->is_full) {
            $lessons = self::GetDatesForLessons(count($request->days_of_week), $request->days_of_week);

        } else {
            $lessons = self::GetDatesForLessons($request->lesson, $request->days_of_week);
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

    private const MoneyPerHour = 75000;
    private const  DeductedPerRating = 500000;

    public static function showSalary($id, $ins_id = null)
    {
        $month_salary = MonthSalary::query()->where('id', $id)->first();
        $month = date('n', strtotime($month_salary->month));
        $year = date('Y', strtotime($month_salary->month));
        $ins = Instructor::query()
            ->where('id', '=', $month_salary->ins_id)
            ->first();
        $lessons = Lesson::query()->with('driver')
            ->where('ins_id', '=', $month_salary->ins_id)
            ->whereMonth('date', '=', $month)
            ->whereYear('date', '=', $year)
            ->get();
        $detail_salary = new Collection();
        $detail_salary->base = array_sum($lessons->pluck('last')->toArray()) * self::MoneyPerHour;
        $detail_salary->minus = ceil(
                array_sum($lessons->pluck('rating')->toArray()) / count($lessons->pluck('rating')->toArray())
            ) * self::DeductedPerRating;
        $detail_salary->total = $month_salary->total_salaries;
        $back = new Collection();
        $back->ins = $ins;
        $back->lessons = $lessons;
        $back->month_salary = $month_salary;
        $back->detail_salary = $detail_salary;
        return $back;
    }

    public static function calculate($request, $id)
    {
        $month_salaries = new Collection();
        $condition = Lesson::query()
            ->where('ins_id', '=', $id)
            ->where('status', '=', LessonStatusEnum::HAPPENED->value)
            ->whereMonth('date', $request->month)
            ->whereYear('date', $request->year);
        $month_salaries->ins_id = $condition->select('ins_id')->first()->ins_id;
        $month_salaries->total_lessons = $condition->count('*');
        $month_salaries->rating = ceil($condition->average('rating'));
        $month_salaries->total_hours = $condition->sum('last');
        $month_salaries->total_salaries = ActionController::MoneyPerHour * $month_salaries->total_hours -
            (5 - $month_salaries->rating) * ActionController::DeductedPerRating;
        return $month_salaries;
    }

}
