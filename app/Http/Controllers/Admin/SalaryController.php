<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Instructor;
use App\Models\MonthSalary;
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
        return view('admin.salary.index');
    }

    public function api()
    {

        return DataTables::of($this->model->orderBy('updated_at')->orderBy('created_at')->get())
            ->editColumn('ins_id', function ($object) {
                return Instructor::where('id', '=', $object->ins_id)->pluck('name')[0];
            })
            ->editColumn('status', function ($object) {
                return $object->status == 0 ? 'Chờ duyệt' : 'Đã duyệt';
            })
            ->addColumn('edit', function ($object) {
                return $object->id;
            })
            ->addColumn('approve', function ($object) {
                return $object->id;
            })
            ->make(true);
    }

    public function calculate()
    {
        DB::beginTransaction();

        $fixed = 75000;
        $diff = 500000;
        $date = new \DateTime();
        $month = $date->format('Y/m/01');
//

        $ins_ids = DB::table('instructors')->select('id')
            ->whereIn('id', function ($query) {
                $time = new \DateTime();
                $query->select('ins_id')
                    ->from('lessons')
                    ->whereMonth('date', $time->format('m'))
                    ->whereYear('date', $time->format('Y'))
                    ->groupBy('ins_id');
            })
            ->pluck('id')->toArray();
        foreach ($ins_ids as $id) {
            $checkExist = MonthSalary::where('ins_id', $id)->where('month', $date->format('Y/m/01'))->first();
            if (!$checkExist) {
                $lessons = DB::table('lessons')
                    ->select('ins_id',
                        DB::raw('count(*) as total_lessons'),
                        DB::raw('avg(rating) as rating'),
                        DB::raw('sum(last) as total_hours'))
                    ->where('ins_id', '=', $id)
                    ->groupBy('ins_id')
                    ->get()->toArray()[0];
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
                        'created_at' => $date,
                    ]);
                    DB::commit();
                } catch (Throwable $e) {
                    report($e);
                    DB::rollBack();
                    return false;
                }
            }

        }
        return redirect()->route('admin.salary.index');


    }

    public function approve(Request $request, $id)
    {
        $alo = MonthSalary::where('id', $id)
            ->update([
                'status' => 1,
            ]);

        return redirect()->route('admin.salary.index');

    }
}
