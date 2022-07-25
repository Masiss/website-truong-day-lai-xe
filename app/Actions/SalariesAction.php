<?php

namespace App\Actions;

use App\Enums\LessonStatusEnum;
use App\Models\Instructor;
use App\Models\Lesson;
use App\Models\MonthSalary;
use Illuminate\Database\Eloquent\Collection;

class SalariesAction
{
    private const MoneyPerHour = 75000;
    private const  DeductedPerRating = 500000;

    public static function showSalary($id, $ins_id = null)
    {
        $month_salary = MonthSalary::query()->where('id', $id)->first();
        $sub=explode('/',$month_salary->month);
        $month=$sub[0];
        $year=$sub[1];
        $ins = Instructor::query()
            ->where('id', '=', $month_salary->ins_id)
            ->first();
        $lessons = Lesson::query()->with('driver')
            ->with('instructor')
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
        if(!$condition->get()->first()){
            return null;
        }
        $month_salaries->ins_id = $condition->select('ins_id')->first()->ins_id;
        $month_salaries->total_lessons = $condition->count('*');
        $month_salaries->rating = ceil($condition->average('rating'));
        $month_salaries->total_hours = $condition->sum('last');
        $month_salaries->total_salaries = self::MoneyPerHour * $month_salaries->total_hours -
            (5 - $month_salaries->rating) * self::DeductedPerRating;
        return $month_salaries;
    }
}
