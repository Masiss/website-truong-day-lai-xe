<?php

namespace App\Http\Controllers;

use App\Models\Instructor;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\View;
use Yajra\DataTables\DataTables;

class InstructorController extends Controller
{
    public function __construct()
    {
        $this->guard = Auth::guard('instructor');
        $route = Route::currentRouteName();
        $breadCrumb = explode('.', $route);
        $pageName = last($breadCrumb);
        View::share('pageName', ucfirst($pageName));
        View::share('breadCrumb', $breadCrumb);
    }

    public function index()
    {
        $ins = Auth::guard('instructor')->user();
        return view('ins.index', [
            'ins' => $ins,
        ]);
    }

    public function salaries()
    {
        return view('ins.salaries');
//        MonthSalary::query()->where('id', $this->guard->user()->id)->get();
    }

    public function api(Request $request)
    {
        return DataTables::of(Instructor::query()->where('instructors.id', $this->guard->user()->id)
            ->join('month_salaries', 'month_salaries.ins_id', '=', 'instructors.id')
            ->get())
            ->editColumn('status', fn($object) => $object->status == 0 ? 'Đang chờ duyệt' : 'Đã duyệt')
            ->editColumn('month', fn($object) => date_format(new \DateTime($object->month), 'm/Y'))
            ->addColumn('show', fn($object) => $object->id)
            ->make(true);
    }

    public function show(Request $request, $id)
    {
        $diff = 500000;
        $month_salary = DB::table('month_salaries')->where('id', $id)->get();
        $date = $month_salary->pluck('month')->toArray()[0];
        $month = date_format(new \DateTime($date), 'm');
        $year = date_format(new \DateTime($date), 'Y');
        $ins = Auth::guard('instructor')->user();
        $lessons = DB::table('lessons')
            ->where('ins_id', '=', $ins->id)
            ->whereMonth('date', '=', $month)
            ->whereYear('date', '=', $year)
            ->join('drivers', 'drivers.id', '=', 'lessons.id')
            ->get();
        $detail_salary = new Collection();
        $detail_salary->base = array_sum($lessons->pluck('last')->toArray()) * 75000;
        $rating = $lessons->pluck('rating')->toArray();
        $detail_salary->minus = ceil(array_sum($rating) / count($rating)) * $diff;

        $detail_salary->total = $detail_salary->base - $detail_salary->minus;

        return view('ins.show', [
            'ins' => $ins,
            'lessons' => $lessons,
            'month_salary' => $month_salary,
            'detail_salary' => $detail_salary,
        ]);
    }

    public function info()
    {

    }


}
