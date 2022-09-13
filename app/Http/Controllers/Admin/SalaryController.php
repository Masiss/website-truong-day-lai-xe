<?php

namespace App\Http\Controllers\Admin;

use App\Actions\SalariesAction;
use App\Enums\SalaryStatusEnum;
use App\Http\Controllers\Controller;
use App\Http\Requests\ApproveSalaryRequest;
use App\Models\Instructor;
use App\Models\MonthSalary;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\View;

class SalaryController extends Controller
{
    public function __construct()
    {
    }

    public function pending()
    {
        $month = date('n', strtotime("-1 month"));
        $year = date('Y');
        $month_salaries = MonthSalary::query()
            ->where('status', SalaryStatusEnum::PENDING->value)
            ->with('instructor')
            ->orderBy('updated_at')
            ->paginate(15);
        $month_salaries->totalPage = ceil($month_salaries->total() / $month_salaries->perPage());
        return view('admin.salaries.pending', [
            'month' => $month,
            'year' => $year,
            'month_salaries' => $month_salaries,
        ]);
    }

    public function approved()
    {
        $month = date('n', strtotime("-1 month"));
        $year = date('Y');
        $month_salaries = MonthSalary::query()
            ->where('status', SalaryStatusEnum::APPROVED->value)
            ->with('instructorWithTrashed')
            ->orderBy('updated_at')
            ->paginate(15);
        $month_salaries->totalPage = ceil($month_salaries->total() / $month_salaries->perPage());
        return view('admin.salaries.approved', [
            'month' => $month,
            'year' => $year,
            'month_salaries' => $month_salaries,
        ]);
    }

    public function monthCalculate(Request $request)
    {

        DB::beginTransaction();

        $ins_ids = Instructor::with([
            'lessons' => function ($query) use ($request) {
                $query->select('ins_id')->whereMonth('date', $request->month)
                    ->whereYear('date', $request->year)
                    ->groupBy('ins_id');
            }
        ])->pluck('id');
        $monthForDB = date('Y/m/01', strtotime("{$request->year}/{$request->month}/01"));
        foreach ($ins_ids as $id) {
            // month column format Y/m/01
            $checkExist = MonthSalary::query()
                ->where('ins_id', $id)
                ->where('month', $monthForDB)
                ->first();
            if (!$checkExist) {
                $month_salaries = SalariesAction::calculateForMonth($request->month, $request->year, $id);
                try {
                    if ($month_salaries) {
                        MonthSalary::query()->create([
                            'ins_id' => $month_salaries->ins_id,
                            'total_hours' => $month_salaries->total_hours,
                            'total_lessons' => $month_salaries->total_lessons,
                            'total_salaries' => $month_salaries->total_salaries,
                            'month' => $monthForDB,
                            'status' => SalaryStatusEnum::PENDING->value,
                        ]);
                        DB::commit();
                    }
                } catch (Throwable $e) {
                    report($e);
                    DB::rollBack();
                    return false;
                }

            }

        }
        return redirect()->route('admin.salaries.pending');


    }

    public function show($id)
    {
        $info = SalariesAction::showSalary($id);
        $info->lessons->totalPage = ceil($info->lessons->total() / $info->lessons->perPage());
        return view('admin.salaries.show', [
            'instructor' => $info->ins,
            'lessons' => $info->lessons,
            'month_salary' => $info->month_salary,
            'detail_salary' => $info->detail_salary,
        ]);
    }

    public function approve(ApproveSalaryRequest $request, $id)
    {
        DB::beginTransaction();
        try {
            // Validate the value...
            $month_salary = MonthSalary::where('id', $id);
            $month_salary->update([
                'status' => SalaryStatusEnum::APPROVED->value,
            ]);
            if ($request->base && $request->total) {
                $month_salary->update([
                    'total_salaries' => $request->total,
                ]);
            }
            DB::commit();
            $salary = MonthSalary::query()->where('id', $id)
                ->with('instructor')
                ->first();
            return redirect()->route('admin.salaries.pending')
                ->with('status', 'Đã duyệt lương cho '.$salary->instructor->name.' với mức lương '.$salary->total_salaries);

        } catch (Throwable $e) {
            report($e);
            DB::rollBack();
            return redirect()
                ->with('status', 'Đã xảy ra lỗi, xem xét lại mức lương')
                ->back();
        }

    }
}
