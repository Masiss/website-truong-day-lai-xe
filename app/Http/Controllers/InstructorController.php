<?php

namespace App\Http\Controllers;

use App\Enums\LessonStatusEnum;
use App\Enums\LevelEnum;
use App\Models\Instructor;
use App\Models\Lesson;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;
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
        $month_salary = DB::table('month_salaries')->where('id', $id)->first();
        $month = date('n', strtotime($month_salary->month));
        $year = date('Y', strtotime($month_salary->month));
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

    public function getLessons(Request $request)
    {
//
        return DataTables::of(DB::table('lessons')->where('ins_id', auth()->guard('instructor')->user()->id)
            ->join('drivers', 'drivers.id', '=', 'lessons.driver_id')
            ->select('*', 'lessons.id as lesson_id')
            ->get())
            ->editColumn('date', fn($object) => date_format(new \DateTime($object->date), 'd/m/Y'))
            ->editColumn('status', fn($object) => LessonStatusEnum::from($object->status)->name)
            ->addColumn('checkin', function ($object) {
                if ($object->status == LessonStatusEnum::HAPPENED->value || $object->status == LessonStatusEnum::CANCELED->value) {
                    return null;
                } else {

                    return $object->lesson_id;
                }
            })
            ->make(true);
    }

    public function checkin()
    {
        return view('ins.checkin');
    }

    public function updateStatus(Request $request, int $id)
    {
        try {
            // Validate the value...
            Lesson::query()->where('id', $id)->update([
                'status' => LessonStatusEnum::HAPPENED->value,
            ]);
            return Redirect::back();
        } catch (Throwable $e) {
            report($e);

            return false;
        }
    }

    public function update(Request $request)
    {
        DB::beginTransaction();
        try {
            // Validate the value...
            $get = DB::table('instructors')->where('id', auth()->guard('instructor')->user()->id)
                ->where('level', LevelEnum::INSTRUCTOR->value);
            if (isset($request->avatar)) {
                $path = Storage::disk('public')->put('avatar', $request->avatar);
                $get->update([
                    'name' => $request->name,
                    'gender' => $request->gender,
                    'birthdate' => $request->birthdate,
                    'phone_numbers' => $request->phone_numbers,
                    'avatar' => $request->avatar,
                ]);
            } else {
                $get->update([
                    'name' => $request->name,
                    'gender' => $request->gender,
                    'birthdate' => $request->birthdate,
                    'phone_numbers' => $request->phone_numbers,
                ]);
            }
            DB::commit();
            return Redirect::back();
        } catch (Throwable $e) {
            DB::rollBack();
            report($e);

            return false;
        }

    }


}
