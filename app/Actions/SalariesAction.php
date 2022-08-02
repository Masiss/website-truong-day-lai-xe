<?php

namespace App\Actions;

use App\Enums\LessonStatusEnum;
use App\Models\Instructor;
use App\Models\Lesson;
use App\Models\MonthSalary;
use Illuminate\Database\Eloquent\Collection;

class SalariesAction
{
    private const MoneyPerHour = 100000;
    private const  DeductedPerRating = 500000;

    public static function showSalary(int $id)
    {
        $month_salary = MonthSalary::query()
            ->where('id', $id)
            ->first();
        $divideMonthYear = explode('/', $month_salary->month);
        $month = $divideMonthYear[0];
        $year = $divideMonthYear[1];
        $ins = Instructor::query()
            ->where('id', '=', $month_salary->ins_id)
            ->first();
        $lessons = Lesson::query()
            ->where('ins_id', '=', $month_salary->ins_id)
            ->with('driver')
            ->whereMonth('date', '=', $month)
            ->whereYear('date', '=', $year)
            ->paginate(7);
        $lastArr = $lessons->pluck('last')->toArray();
        $ratingArr = $lessons->pluck('rating')->toArray();
        $detail_salary = self::calculateForDetail($lastArr, $ratingArr, $month_salary->total_salaries);
        $detail_salary->rating = ceil(array_sum($ratingArr) / count($ratingArr));
        $back = new Collection();
        $back->ins = $ins;
        $back->lessons = $lessons;
        $back->month_salary = $month_salary;
        $back->detail_salary = $detail_salary;
        return $back;
    }

    public static function calculateForDetail(array $last, array $rating, $total)
    {
        $detail_salary = new Collection();
        $detail_salary->base = array_sum($last) * self::MoneyPerHour;
        $detail_salary->minus = ceil(
                array_sum($rating) / count($rating)
            ) * self::DeductedPerRating;
        $detail_salary->total = $total;
        return $detail_salary;
    }

    public static function calculateForMonth($month, $year, int $id)
    {
        $month_salaries = new Collection();
        $happenedLessons = Lesson::query()
            ->where('ins_id', '=', $id)
            ->where('status', '=', LessonStatusEnum::HAPPENED->value)
            ->whereMonth('date', $month)
            ->whereYear('date', $year);
        if (!$happenedLessons->first()) {
            return null;
        }
        $month_salaries->ins_id = $happenedLessons->pluck('ins_id')->first();
        $month_salaries->total_lessons = $happenedLessons->count('*');
        $month_salaries->rating = ceil($happenedLessons->average('rating'));
        $month_salaries->total_hours = $happenedLessons->sum('last');
        $month_salaries->total_salaries = self::MoneyPerHour * $month_salaries->total_hours -
            (5 - $month_salaries->rating) * self::DeductedPerRating;
        return $month_salaries;
    }


}
