<?php

namespace App\Http\Controllers\Admin;

use App\Enums\LessonStatusEnum;
use App\Enums\SalaryStatus;
use App\Http\Controllers\Controller;
use App\Models\MonthSalary;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\View;
use Yajra\DataTables\DataTables;

class SalaryController extends Controller
{
    public function __construct()
    {
        $this->model = MonthSalary::query();
        $route = Route::currentRouteName();
        $breadCrumb = explode('.', $route);
        $pageName = last($breadCrumb);
        View::share('pageName', ucfirst($pageName));
        View::share('breadCrumb', $breadCrumb);
    }

    public function index()
    {
        $now = new \DateTime();
        $month = $now->format('m');
        $month--;
        $year = $now->format('Y');
        return view('admin.salaries.index', [
            'month' => $month,
            'year' => $year,
        ]);
    }

    public function api()
    {

        return DataTables::of(MonthSalary::query()
            ->join('instructors', 'instructors.id', '=', 'month_salaries.ins_id')
            ->get())
            ->editColumn('ins_id', function ($object) {
                return $object->name;
            })
            ->editColumn('month', fn($object) => date_format(new \DateTime($object->month), 'm/Y'))
            ->editColumn('status', fn($object) => SalaryStatus::from($object->status)->name)
            ->editColumn('created_at', fn($object) => $object->created_at)
            ->addColumn('show', fn($object) => $object->id)
            ->addColumn('approve', fn($object) => $object->id)
            ->make(true);
    }

    public function calculate(Request $request)
    {

        DB::beginTransaction();
        $fixed = 75000;
        $diff = 500000;
        $today = new \DateTime();
        $month = $request->month;
        $year = $request->year;
        $str = '01/'.$month.'/'.$year;
        $month = \DateTime::createFromFormat('d/m/Y', $str)->format('Y/m/d');
        $sub_query = DB::table('lessons')->select('ins_id')
            ->whereMonth('date', $request->month)
            ->whereYear('date', $request->year)
            ->groupBy('ins_id')->pluck('ins_id');
        $ins_ids = DB::table('instructors')->select('id')
            ->whereIn('id', $sub_query)->get()->pluck('id');
        foreach ($ins_ids as $id) {
            $checkExist = MonthSalary::where('ins_id', $id)->where('month', $month)->first();
            if (!$checkExist) {
                $lessons = DB::table('lessons')
                    ->select('ins_id',
                        DB::raw('count(*) as total_lessons'),
                        DB::raw('avg(rating) as rating'),
                        DB::raw('sum(last) as total_hours'))
                    ->where('ins_id', '=', $id)
                    ->where('status', '=', LessonStatusEnum::HAPPENED->value)
                    ->whereMonth('date', $request->month)
                    ->whereYear('date', $request->year)
                    ->groupBy('ins_id')
                    ->first();
                if ($lessons) {

                    $ins_id = $lessons->ins_id;
                    $total_hours = $lessons->total_hours;
                    $rating = ceil($lessons->rating);
                    $total_lessons = $lessons->total_lessons;
                    $salary = $fixed * $total_hours - (5 - $rating) * $diff;
                    try {
                        MonthSalary::query()->insert([
                            'ins_id' => $ins_id,
                            'total_hours' => $total_hours,
                            'total_lessons' => $total_lessons,
                            'total_salaries' => $salary,
                            'month' => $month,
                            'created_at' => $today,
                        ]);
                        DB::commit();
                    } catch (Throwable $e) {
                        report($e);
                        DB::rollBack();
                        return false;
                    }
                }

            }

        }
        return redirect()->route('admin.salaries.index');


    }

    public function show($id)
    {
        $diff = 500000;
        $month_salary = DB::table('month_salaries')->where('id', $id)->get();
        $ins_id = $month_salary->pluck('ins_id');
        $date = $month_salary->pluck('month')->toArray()[0];
        $month = date_format(new \DateTime($date), 'm');
        $year = date_format(new \DateTime($date), 'Y');
        $ins = DB::table('instructors')->where('id', '=', $ins_id)->first();
        $lessons = DB::table('lessons')
            ->where('ins_id', '=', $ins_id)
            ->whereMonth('date', '=', $month)
            ->whereYear('date', '=', $year)
            ->join('drivers', 'drivers.id', '=', 'lessons.id')
            ->get();
        $detail_salary = new Collection();
        $detail_salary->base = array_sum($lessons->pluck('last')->toArray()) * 75000;
        $rating = $lessons->pluck('rating')->toArray();
        $detail_salary->minus = ceil(array_sum($rating) / count($rating)) * $diff;

        $detail_salary->total = $detail_salary->base - $detail_salary->minus;

        return view('admin.salaries.show', [
            'ins' => $ins,
            'lessons' => $lessons,
            'month_salary' => $month_salary,
            'detail_salary' => $detail_salary,
        ]);
    }

    public function approve(Request $request, $id)
    {
        $alo = MonthSalary::where('id', $id)
            ->update([
                'status' => 1,
            ]);

        return redirect()->route('admin.salaries.index');

    }
}
